<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_info' => 'required|array',
            'billing_info.name' => 'required|string|max:255',
            'billing_info.phone' => 'required|string|max:20',
            'billing_info.address' => 'required|string|max:500',
            'billing_info.district' => 'required|string|max:100',
            'billing_info.thana' => 'required|string|max:100',
            'billing_info.email' => 'nullable|email|max:255',
            'shipping_info' => 'nullable|array',
            'shipping_info.address' => 'nullable|string|max:500',
            'payment_method' => 'required|string|in:cashOnDelivery,bkash,rocket,nagad',
            'order_notes' => 'nullable|string|max:1000',
            'total_amount' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.name' => 'required|string|max:255',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        try {
            $order = Order::create([
                'billing_info' => $validated['billing_info'],
                'shipping_info' => $validated['shipping_info'] ?? null,
                'payment_method' => $validated['payment_method'],
                'order_notes' => $validated['order_notes'] ?? null,
                'total_amount' => $validated['total_amount'],
                'items' => $validated['items'],
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'message' => 'Order placed successfully!'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return Inertia::render('OrderConfirmed', [
            'order' => $order
        ]);
    }
}
