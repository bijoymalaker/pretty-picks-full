<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4">Billing Details</h2>
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="country">Country/Region</label>
                            <select class="custom-select" id="country" v-model="billing.country">
                                <option value="">Choose...</option>
                                <option value="bangladesh">Bangladesh</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name" required
                                v-model="billing.name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Phone Number" required
                                v-model="billing.phone">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address"
                                placeholder="House number and street address" required v-model="billing.address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" placeholder="District" required
                                v-model="billing.district">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="thana">Thana/Upazela</label>
                            <input type="text" class="form-control" id="thana" placeholder="Thana/Upazela" required
                                v-model="billing.thana">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email address (optional)</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                v-model="billing.email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="shipToDifferentAddress"
                                v-model="shipToDifferentAddress">
                            <label class="form-check-label" for="shipToDifferentAddress">Ship to a different
                                address?</label>
                        </div>
                    </div>
                    <div class="form-group" v-if="shipToDifferentAddress">
                        <label for="shippingAddress">Shipping Address</label>
                        <input type="text" class="form-control" id="shippingAddress" placeholder="Shipping Address"
                            v-model="shipping.address">
                    </div>
                    <div class="form-group">
                        <label for="orderNotes">Order notes (optional)</label>
                        <textarea class="form-control" id="orderNotes" rows="3"
                            placeholder="Notes about your order, e.g. special notes for delivery"
                            v-model="orderNotes"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Order</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in cartStore.cart" :key="index">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>৳ {{ item.price }}</td>
                                    <td>৳ {{ item.price * item.qty }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-6">Subtotal</div>
                            <div class="col-6">৳ {{ cartStore.cartTotal }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Shipping</div>
                            <div class="col-6">Delivery Charge: ৳ 70</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">Total</div>
                            <div class="col-6">৳ {{ cartStore.cartTotal + 70 }}</div>
                        </div>
                        <hr>
                        <h5 class="card-title">Payment</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery"
                                value="cashOnDelivery" v-model="paymentMethod">
                            <label class="form-check-label" for="cashOnDelivery">Cash on delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="bkash" value="bkash"
                                v-model="paymentMethod">
                            <label class="form-check-label" for="bkash">bKash Send Money</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="rocket" value="rocket"
                                v-model="paymentMethod">
                            <label class="form-check-label" for="rocket">Rocket Send Money</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="nagad" value="nagad"
                                v-model="paymentMethod">
                            <label class="form-check-label" for="nagad">Nagad Send Money</label>
                        </div>
                        <button type="button" class="btn btn-primary btn-block mt-3" @click="placeOrder">Place
                            Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import AppLayouts from '@/layout/AppLayouts.vue';
import { useCartStore } from '../stores/cart';
import { ref, watch } from 'vue';

defineOptions({
  name: 'Checkout',
  layout: AppLayouts,
})

const cartStore = useCartStore()

const billing = ref({
  country: '',
  name: '',
  phone: '',
  address: '',
  district: '',
  thana: '',
  email: '',
})

const shipping = ref({
  address: '',
})

const shipToDifferentAddress = ref(false)
const orderNotes = ref('')
const paymentMethod = ref('cashOnDelivery')

const placeOrder = () => {
  // Validate form and place order logic here
  console.log('Billing Details:', billing.value)
  console.log('Shipping Address:', shipToDifferentAddress.value ? shipping.value.address : billing.value.address)
  console.log('Order Notes:', orderNotes.value)
  console.log('Payment Method:', paymentMethod.value)
  console.log('Cart Items:', cartStore.cart.value)
  console.log('Total:', cartStore.cartTotal.value + 70)
  
  // Here you would typically send the order to your backend
  // After successful order placement, clear the cart
  // cartStore.clearCart()
}
</script>

<style scoped>
/* Add your custom styles here */
</style>