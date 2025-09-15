<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Inertia\Inertia;
use App\Models\Order;

class SslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $data = $request->all();

        $post_data = array();
        $post_data['total_amount'] = $data['total_amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $data['billing_info']['name'] ?? 'Customer Name';
        $post_data['cus_email'] = $data['billing_info']['email'] ?? 'customer@mail.com';
        $post_data['cus_add1'] = $data['billing_info']['address'] ?? 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $data['billing_info']['district'] ?? "";
        $post_data['cus_state'] = $data['billing_info']['thana'] ?? "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = $data['billing_info']['country'] ?? "Bangladesh";
        $post_data['cus_phone'] = $data['billing_info']['phone'] ?? '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        if (!empty($data['shipping_info'])) {
            $post_data['ship_name'] = $data['billing_info']['name'] ?? "Store Test";
            $post_data['ship_add1'] = $data['shipping_info']['address'] ?? "Dhaka";
            $post_data['ship_add2'] = "";
            $post_data['ship_city'] = $data['billing_info']['district'] ?? "Dhaka";
            $post_data['ship_state'] = $data['billing_info']['thana'] ?? "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = $data['billing_info']['phone'] ?? "";
            $post_data['ship_country'] = $data['billing_info']['country'] ?? "Bangladesh";
        } else {
            $post_data['ship_name'] = $data['billing_info']['name'] ?? "Store Test";
            $post_data['ship_add1'] = $data['billing_info']['address'] ?? "Dhaka";
            $post_data['ship_add2'] = "";
            $post_data['ship_city'] = $data['billing_info']['district'] ?? "Dhaka";
            $post_data['ship_state'] = $data['billing_info']['thana'] ?? "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = $data['billing_info']['phone'] ?? "";
            $post_data['ship_country'] = $data['billing_info']['country'] ?? "Bangladesh";
        }

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Order Payment";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        Order::updateOrCreate(
            ['transaction_id' => $post_data['tran_id']],
            [
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
               
            ]
        );

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order table against the transaction id or order id.
        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('payment.fail', ['tran_id' => $tran_id]);
        }

        if ($order->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $order->update(['status' => 'Processing']);

                // Redirect to success page with order details
                return redirect()->route('payment.success', ['tran_id' => $tran_id]);

            }
        } else if ($order->status == 'Processing' || $order->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to update database.
             */
            return redirect()->route('payment.success', ['tran_id' => $tran_id]);

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return redirect()->route('payment.fail', ['tran_id' => $tran_id]);
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('payment.fail', ['tran_id' => $tran_id]);
        }

        if ($order->status == 'Pending') {
            $order->update(['status' => 'Failed']);

            return redirect()->route('payment.fail', ['tran_id' => $tran_id]);

        } else if ($order->status == 'Processing' || $order->status == 'Complete') {
            return redirect()->route('payment.success', ['tran_id' => $tran_id]);
        } else {
            return redirect()->route('payment.fail', ['tran_id' => $tran_id]);
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('payment.cancel', ['tran_id' => $tran_id]);
        }

        if ($order->status == 'Pending') {
            $order->update(['status' => 'Canceled']);

            return redirect()->route('payment.cancel', ['tran_id' => $tran_id]);
        } else if ($order->status == 'Processing' || $order->status == 'Complete') {
            return redirect()->route('payment.success', ['tran_id' => $tran_id]);
        } else {
            return redirect()->route('payment.cancel', ['tran_id' => $tran_id]);
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order = Order::where('transaction_id', $tran_id)->first();

            if (!$order) {
                echo "Invalid Transaction";
                return;
            }

            if ($order->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order->amount ?? $order->total_amount, $order->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $order->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order->status == 'Processing' || $order->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Generate unique transaction ID for cash on delivery
        $tran_id = uniqid();

        // Create order using Eloquent model
        $order = Order::create([
            'name' => $data['billing_info']['name'],
            'email' => $data['billing_info']['email'] ?? null,
            'phone' => $data['billing_info']['phone'],
            'amount' => $data['total_amount'],
            'address' => $data['billing_info']['address'],
            'status' => 'Pending',
            'transaction_id' => $tran_id,
            'currency' => 'BDT',
        ]);

        // Return order ID for redirection
        return response()->json(['order_id' => $order->id]);
    }

    public function show($order_id)
    {
        // Retrieve order details using Eloquent model
        $order = Order::find($order_id);

        if (!$order) {
            abort(404, 'Order not found');
        }

        return Inertia::render('OrderConfirmed', [
            'order' => $order
        ]);
    }

}
