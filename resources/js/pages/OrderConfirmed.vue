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

                        <!-- Order Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Order Information</h5>
                                <p><strong>Order ID:</strong> {{ order.id }}</p>
                                <p><strong>Order Date:</strong> {{ formatDate(order.created_at) }}</p>
                                <p><strong>Total Amount:</strong> ৳ {{ order.amount }}</p>
                                <p><strong>Status:</strong>
                                    <span class="badge bg-primary">{{ order.status || 'Pending' }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Billing Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5>Billing Information</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>Name:</strong> {{ order.name }}</p>
                                        <p><strong>Phone:</strong> {{ order.phone }}</p>
                                        <p><strong>Address:</strong> {{ order.address }}</p>
                                        <p v-if="order.email"><strong>Email:</strong> {{ order.email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5>Payment Information</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>Transaction ID:</strong> {{ order.transaction_id || 'N/A' }}</p>
                                        <p><strong>Currency:</strong> {{ order.currency || 'BDT' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Next Steps -->
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <div class="alert alert-info" role="alert">
                                    <h6 class="alert-heading">What's Next?</h6>
                                    <p class="mb-2">You will receive a confirmation call shortly.</p>
                                    <p class="mb-0">For any queries, please contact us at: <strong>{{ order.phone }}</strong></p>
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

// Helper function: Format Date
const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-GB', {
    day: '2-digit',
    month: 'short',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
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
