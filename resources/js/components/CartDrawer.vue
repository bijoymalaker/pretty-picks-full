<template>
  <div v-if="isOpen" class="cart-drawer-backdrop" @click.self="closeDrawer">
    <div class="cart-drawer">
      <div class="cart-header">
        <h5>Your Cart</h5>
        <button class="btn-close" @click="closeDrawer"></button>
      </div>
      <div class="cart-body">
        <div v-if="cart.length === 0">Your cart is empty.</div>
        <div v-for="(item, idx) in cart" :key="idx" class="cart-item">
          <img :src="item.image" alt="" class="cart-item-img" />
          <div>
            <div>{{ item.name }}</div>
            <div>Qty: {{ item.qty }}</div>
            <div>Price: ${{ item.price }}</div>
          </div>
        </div>
      </div>
      <div class="cart-footer">
        <button class="btn btn-primary w-100" @click="checkout">Checkout</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject } from 'vue'
const cart = inject('cart')
const isOpen = inject('cartDrawerOpen')
const setDrawerOpen = inject('setCartDrawerOpen')

function closeDrawer() {
  setDrawerOpen(false)
}
function checkout() {
  alert('Proceed to checkout!')
}
</script>

<style scoped>
.cart-drawer-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.3);
  z-index: 1050;
}
.cart-drawer {
  position: fixed;
  top: 0;
  right: 0;
  width: 350px;
  height: 100%;
  background: #fff;
  box-shadow: -2px 0 8px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  z-index: 1100;
  animation: slideIn 0.3s;
}
@keyframes slideIn {
  from { right: -400px; }
  to { right: 0; }
}
.cart-header, .cart-footer {
  padding: 1rem;
  border-bottom: 1px solid #eee;
}
.cart-footer {
  border-top: 1px solid #eee;
  border-bottom: none;
  margin-top: auto;
}
.cart-body {
  flex: 1;
  overflow-y: auto;
  padding: 1rem;
}
.cart-item {
  display: flex;
  gap: 10px;
  margin-bottom: 1rem;
}
.cart-item-img {
  width: 50px;
  height: 50px;
  object-fit: cover;
}
</style>