<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h2 class="mb-0">🎉 Order Confirmed!</h2>
                    </div>
                    <div class="card-body">
                        <!-- Order Summary -->
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Thank you for your order!</h4>
                            <p class="mb-0">Your order has been successfully placed and is being processed.</p>
                        </div>

                        <!-- Order Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Order Information</h5>
                                <p><strong>Order Number:</strong> {{ order.order_number }}</p>
                                <p><strong>Order Date:</strong> {{ order.formatted_date }}</p>
                                <p><strong>Total Amount:</strong> {{ order.formatted_total }}</p>
                                <p><strong>Payment Method:</strong> {{ formatPaymentMethod(order.payment_method) }}</p>
                                <p><strong>Status:</strong> <span class="badge bg-primary">{{ order.status }}</span></p>
                            </div>
                        </div>

                        <!-- Billing Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5>Billing Information</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>Name:</strong> {{ order.billing_info.name }}</p>
                                        <p><strong>Phone:</strong> {{ order.billing_info.phone }}</p>
                                        <p><strong>Address:</strong> {{ order.billing_info.address }}</p>
                                        <p><strong>District:</strong> {{ order.billing_info.district }}</p>
                                        <p><strong>Thana/Upazela:</strong> {{ order.billing_info.thana }}</p>
                                        <p v-if="order.billing_info.email"><strong>Email:</strong> {{ order.billing_info.email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Information (if different) -->
                        <div class="row mb-4" v-if="order.shipping_info && order.shipping_info.address">
                            <div class="col-12">
                                <h5>Shipping Information</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>Shipping Address:</strong> {{ order.shipping_info.address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="row mb-4" v-if="order.order_notes">
                            <div class="col-12">
                                <h5>Order Notes</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ order.order_notes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="row">
                            <div class="col-12">
                                <h5>Order Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in order.items" :key="index">
                                                <td>{{ item.name }}</td>
                                                <td>{{ item.qty }}</td>
                                                <td>৳ {{ item.price }}</td>
                                                <td>৳ {{ item.price * item.qty }}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                                <td><strong>৳ {{ calculateSubtotal() }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Delivery Charge:</strong></td>
                                                <td><strong>৳ 70</strong></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                <td><strong>৳ {{ order.total_amount }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Next Steps -->
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <div class="alert alert-info" role="alert">
                                    <h6 class="alert-heading">What's Next?</h6>
                                    <p class="mb-2">You will receive a confirmation call shortly.</p>
                                    <p class="mb-0">For any queries, please contact us at: <strong>{{ order.billing_info.phone }}</strong></p>
                                </div>
                                <router-link to="/" class="btn btn-primary me-2">Continue Shopping</router-link>
                                <router-link to="/shop" class="btn btn-outline-secondary">Browse More Products</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AppLayouts from '@/layout/AppLayouts.vue';

defineOptions({
  name: 'OrderConfirmed',
  layout: AppLayouts,
})

const props = defineProps({
  order: {
    type: Object,
    required: true
  }
})

const formatPaymentMethod = (method) => {
  const methods = {
    cashOnDelivery: 'Cash on Delivery',
    bkash: 'bKash Send Money',
    rocket: 'Rocket Send Money',
    nagad: 'Nagad Send Money'
  }
  return methods[method] || method
}

const calculateSubtotal = () => {
  return props.order.items.reduce((total, item) => total + (item.price * item.qty), 0)
}
</script>

<style scoped>
.card {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.card-header {
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.badge {
    font-size: 0.875em;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.btn {
    border-radius: 0.375rem;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}
</style>
