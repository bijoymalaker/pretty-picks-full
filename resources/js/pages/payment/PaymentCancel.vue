<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-white text-center">
                        <h2 class="mb-0">⚠️ Payment Cancelled</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Payment Cancelled</h4>
                            <p class="mb-0">You have cancelled the payment process.</p>
                        </div>

                        <div v-if="order_details" class="order-details mb-4">
                            <h5>Order Details:</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p><strong>Transaction ID:</strong> {{ order_details.transaction_id }}</p>
                                    <p><strong>Amount:</strong> {{ order_details.amount }} {{ order_details.currency }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><strong>Customer:</strong> {{ order_details.name }}</p>
                                    <p><strong>Email:</strong> {{ order_details.email }}</p>
                                    <p><strong>Status:</strong> <span class="badge bg-warning">{{ order_details.status }}</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p>If this was a mistake, you can try again.</p>
                            <router-link to="/checkout" class="btn btn-primary me-2">Try Again</router-link>
                            <router-link to="/" class="btn btn-outline-secondary">Go Home</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AppLayouts from '@/layout/AppLayouts.vue';

defineProps({
  order_details: {
    type: Object,
    default: null
  }
});

defineOptions({
  name: 'PaymentCancel',
  layout: AppLayouts,
})
</script>

<style scoped>
.card {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.card-header {
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
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
