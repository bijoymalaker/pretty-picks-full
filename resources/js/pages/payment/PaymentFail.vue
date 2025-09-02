<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white text-center">
                        <h2 class="mb-0">❌ Payment Failed!</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Payment Failed</h4>
                            <p class="mb-0">Unfortunately, your payment could not be processed.</p>
                        </div>

                        <div class="text-center mt-4">
                            <p>Please try again or contact support if the issue persists.</p>
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

defineOptions({
  name: 'PaymentFail',
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
