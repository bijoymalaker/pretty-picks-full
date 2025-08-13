<template>
  <div v-if="isOpen || isClosing" class="cart-drawer-backdrop" @click.self="closeDrawer">
    <div :class="['cart-drawer', isClosing ? 'slide-out' : 'slide-in']">
      <div class="cart-header d-flex justify-content-between align-items-center">
        <h5>Your Cart ({{ cartItemsCount }})</h5>
        <button class="btn-close" @click="closeDrawer"></button>
      </div>
      
      <div class="cart-body">
        <div v-if="cart.length === 0" class="empty-cart text-center py-5">
          <FontAwesomeIcon icon="fa-solid fa-shopping-cart" class="fs-1 text-muted mb-3" />
          <p class="text-muted">Your cart is empty</p>
          <button class="btn btn-outline-primary" @click="closeDrawer">Continue Shopping</button>
        </div>
        
        <div v-else>
          <div v-for="item in cart" :key="item.id" class="cart-item">
            <img 
              :src="getProductImage(item)" 
              :alt="item.name" 
              class="cart-item-img"
              @error="handleImageError"
            />
            <div class="cart-item-details">
              <div class="cart-item-name">{{ item.name }}</div>
              <div class="cart-item-price">${{ formatPrice(item.price) }}</div>
              
              <div class="cart-item-controls">
                <button 
                  class="btn btn-sm btn-outline-secondary" 
                  @click="decreaseQuantity(item.id)"
                  :disabled="item.qty <= 1"
                >
                  <FontAwesomeIcon icon="fa-solid fa-minus" />
                </button>
                
                <span class="quantity">{{ item.qty }}</span>
                
                <button 
                  class="btn btn-sm btn-outline-secondary" 
                  @click="increaseQuantity(item.id)"
                >
                  <FontAwesomeIcon icon="fa-solid fa-plus" />
                </button>
                
                <button 
                  class="btn btn-sm btn-outline-danger ms-2" 
                  @click="removeItem(item.id)"
                >
                  <FontAwesomeIcon icon="fa-solid fa-trash" />
                </button>
              </div>
              
              <div class="cart-item-subtotal">
                Subtotal: ${{ formatPrice(item.price * item.qty) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div v-if="cart.length > 0" class="cart-footer">
        <div class="cart-summary mb-3">
          <div class="d-flex justify-content-between">
            <strong>Total:</strong>
            <strong>${{ formatPrice(cartTotal) }}</strong>
          </div>
        </div>
        
        <div class="cart-actions">
          <button class="btn btn-outline-secondary w-100 mb-2" @click="closeDrawer">
            Continue Shopping
          </button>
          <button class="btn btn-primary w-100" @click="checkout">
            Proceed to Checkout
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue'
import { route } from 'ziggy-js'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const cart = inject('cart')
const isOpen = inject('cartDrawerOpen')
const setDrawerOpen = inject('setCartDrawerOpen')
const removeFromCart = inject('removeFromCart')
const updateQuantity = inject('updateQuantity')

const isClosing = ref(false)

// Computed properties
const cartItemsCount = computed(() => {
  return cart.value.reduce((count, item) => count + item.qty, 0)
})

const cartTotal = computed(() => {
  return cart.value.reduce((total, item) => total + (item.price * item.qty), 0)
})

function closeDrawer() {
  isClosing.value = true
  setTimeout(() => {
    setDrawerOpen(false)
    isClosing.value = false
  }, 300)
}

function getProductImage(product) {
  if (product.image) {
    return `/storage/${product.image}`
  }
  return 'https://via.placeholder.com/300x200?text=No+Image'
}

function handleImageError(event) {
  event.target.src = 'https://via.placeholder.com/300x200?text=No+Image'
}

function formatPrice(price) {
  return Number(price).toFixed(2)
}

function increaseQuantity(productId) {
  const item = cart.value.find(item => item.id === productId)
  if (item) {
    updateQuantity(productId, item.qty + 1)
  }
}

function decreaseQuantity(productId) {
  const item = cart.value.find(item => item.id === productId)
  if (item && item.qty > 1) {
    updateQuantity(productId, item.qty - 1)
  }
}

function removeItem(productId) {
  removeFromCart(productId)
}

function checkout() {
  closeDrawer()
  window.location.href = route('checkout')
}

// Reset isClosing when drawer is opened
watch(isOpen, (val) => {
  if (val) isClosing.value = false
})
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
  width: 380px;
  height: 100%;
  background: #fff;
  box-shadow: -2px 0 8px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  z-index: 1100;
}

.slide-in {
  animation: slideIn 0.3s forwards;
}

.slide-out {
  animation: slideOut 0.3s forwards;
}

@keyframes slideIn {
  from { right: -400px; }
  to { right: 0; }
}

@keyframes slideOut {
  from { right: 0; }
  to { right: -400px; }
}

.cart-header, .cart-footer {
  padding: 1rem;
  border-bottom: 1px solid #eee;
}

.cart-footer {
  border-top: 1px solid #eee;
  border-bottom: none;
}

.cart-body {
  flex: 1;
  overflow-y: auto;
  padding: 1rem;
}

.empty-cart {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 300px;
}

.cart-item {
  display: flex;
  gap: 15px;
  margin-bottom: 1rem;
  padding: 1rem;
  border: 1px solid #eee;
  border-radius: 8px;
}

.cart-item-img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 4px;
}

.cart-item-details {
  flex: 1;
}

.cart-item-name {
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.cart-item-price {
  color: #666;
  margin-bottom: 0.5rem;
}

.cart-item-controls {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 0.5rem;
}

.quantity {
  min-width: 30px;
  text-align: center;
  font-weight: 600;
}

.cart-item-subtotal {
  font-weight: 600;
  color: #333;
}

.cart-summary {
  padding: 1rem;
  background-color: #f8f9fa;
  border-radius: 8px;
}

.cart-actions {
  padding: 1rem;
}
</style>
