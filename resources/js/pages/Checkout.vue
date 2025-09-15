<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4">Billing Details</h2>
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="country">Country/Region</label>
                            <select class="custom-select" id="country" v-model="billing.country" required>
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
                            <textarea type="text" class="form-control" id="address"
                                placeholder="House number and street address" required v-model="billing.address"></textarea>
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
                            <input class="form-check-input" type="radio" name="paymentMethod" id="onlinePayment" value="onlinePayment"
                                v-model="paymentMethod">
                            <label class="form-check-label" for="onlinePayment">Online Payment</label>
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

const placeOrder = async () => {
  // Validate required fields
  if (!billing.value.name || !billing.value.phone || !billing.value.address || !billing.value.district || !billing.value.thana) {
    alert('Please fill in all required billing details.')
    return
  }

  if (!paymentMethod.value) {
    alert('Please select a payment method.')
    return
  }

  if (cartStore.cart.length === 0) {
    alert('Your cart is empty.')
    return
  }

  // Create form data object
  const formData = {
    billing_info: billing.value,
    shipping_info: shipToDifferentAddress.value ? shipping.value : null,
    payment_method: paymentMethod.value,
    order_notes: orderNotes.value,
    total_amount: cartStore.cartTotal + 70,
    items: cartStore.cart.map(item => ({
      id: item.id,
      name: item.name,
      price: item.price,
      qty: item.qty
    }))
  }

  if (paymentMethod.value === 'onlinePayment') {
    // Create a form element and submit it to /pay
    const form = document.createElement('form')
    form.method = 'POST'
    form.action = '/pay'

    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    const csrfInput = document.createElement('input')
    csrfInput.type = 'hidden'
    csrfInput.name = '_token'
    csrfInput.value = csrfToken
    form.appendChild(csrfInput)

    // Add form data as hidden inputs
    Object.keys(formData).forEach(key => {
      if (typeof formData[key] === 'object' && formData[key] !== null) {
        // Handle nested objects
        Object.keys(formData[key]).forEach(subKey => {
          const input = document.createElement('input')
          input.type = 'hidden'
          input.name = `${key}[${subKey}]`
          input.value = formData[key][subKey] || ''
          form.appendChild(input)
        })
      } else {
        const input = document.createElement('input')
        input.type = 'hidden'
        input.name = key
        input.value = formData[key] || ''
        form.appendChild(input)
      }
    })

    // Append form to body and submit
    document.body.appendChild(form)
    form.submit()
  } else if (paymentMethod.value === 'cashOnDelivery') {
    // Submit order data to /order endpoint via fetch
    try {
      const response = await fetch('/order', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify(formData)
      })

      if (response.ok) {
        const data = await response.json(); // ✅ Convert response to JSON
        if (data.order_id) {
          cartStore.clearCart(); // Clear the cart after successful order
          window.location.href = `/order-confirmed/${data.order_id}`;
        } else {
          alert('Order placed but no order ID returned.');
        }
      } else {
        alert('Failed to place order. Please try again.');
      }
    } catch (error) {
      alert('An error occurred while placing the order.')
      console.error(error)
    }
  }
}
</script>

<style scoped>

</style>