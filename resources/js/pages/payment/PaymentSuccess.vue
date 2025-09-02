<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h2 class="mb-0">✅ Payment Successful!</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Thank you for your payment!</h4>
                            <p class="mb-0">Your payment has been processed successfully.</p>
                        </div>

                        <div class="text-center mt-4">
                            <p>You will receive a confirmation email shortly.</p>
                            <router-link to="/" class="btn btn-primary me-2">Continue Shopping</router-link>
                            <router-link to="/shop" class="btn btn-outline-secondary">Browse More Products</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AppLayouts from '@/layout/AppLayouts.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const order = ref(null);

onMounted(async () => {
  const orderId = route.query.order;
  if (orderId) {
    try {
      const response = await fetch(`/api/orders/${orderId}`);
      if (response.ok) {
        order.value = await response.json();
      }
    } catch (error) {
      console.error('Failed to fetch order details:', error);
    }
  }
});

defineOptions({
  name: 'PaymentSuccess',
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
