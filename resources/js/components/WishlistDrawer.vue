<template>
  <div v-if="isOpen || isClosing" class="wishlist-drawer-backdrop" @click.self="closeDrawer">
    <div :class="['wishlist-drawer', isClosing ? 'slide-out' : 'slide-in']">
      <div class="drawer-header d-flex justify-content-between align-items-center">
        <h5>Your Wishlist ({{ wishlistItemsCount }})</h5>
        <button class="btn-close" @click="closeDrawer"></button>
      </div>
      
      <div class="drawer-body">
        <div v-if="wishlist.length === 0" class="empty-wishlist text-center py-5">
          <FontAwesomeIcon icon="fa-regular fa-heart" class="fs-1 text-muted mb-3" />
          <p class="text-muted">Your wishlist is empty</p>
          <button class="btn btn-outline-primary" @click="closeDrawer">Continue Shopping</button>
        </div>
        
        <div v-else>
          <div v-for="item in wishlist" :key="item.id" class="drawer-item">
            <img 
              :src="getProductImage(item)" 
              :alt="item.name" 
              class="drawer-item-img"
              @error="handleImageError"
            />
            <div class="drawer-item-details">
              <div class="drawer-item-name">{{ item.name }}</div>
              <div class="drawer-item-price">${{ formatPrice(item.price) }}</div>
              
              <div class="drawer-item-actions mt-2">
                <button 
                  class="btn btn-sm btn-primary me-2" 
                  @click="addToCart(item)"
                >
                  <FontAwesomeIcon icon="fa-solid fa-cart-plus" /> Add to Cart
                </button>
                <button 
                  class="btn btn-sm btn-outline-danger" 
                  @click="removeItem(item.id)"
                >
                  <FontAwesomeIcon icon="fa-solid fa-trash" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useWishlistStore } from '../stores/wishlist'
import { useCartStore } from '../stores/cart'

const wishlistStore = useWishlistStore()
const cartStore = useCartStore()
const isOpen = ref(false)
const isClosing = ref(false)
const page = usePage()

// Get user authentication state
const user = computed(() => {
    return page.props.auth && page.props.auth.user ? page.props.auth.user : null
})

// Computed properties
const wishlist = computed(() => wishlistStore.wishlist)
const wishlistItemsCount = computed(() => wishlistStore.wishlistItemsCount)

function openDrawer() {
  isOpen.value = true
}

function closeDrawer() {
  isClosing.value = true
  setTimeout(() => {
    isOpen.value = false
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

function addToCart(product) {
  if (!user.value) {
    alert('Please login to add items to the cart.')
    return
  }
  cartStore.addToCart(product)
  wishlistStore.removeFromWishlist(product.id)
}

function removeItem(productId) {
  wishlistStore.removeFromWishlist(productId)
}

// Reset isClosing when drawer is opened
watch(isOpen, (val) => {
  if (val) isClosing.value = false
})

// Expose methods for parent components
defineExpose({
  openDrawer,
  closeDrawer,
  isOpen
})
</script>

<style scoped>
.wishlist-drawer-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.3);
  z-index: 1050;
}

.wishlist-drawer {
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

.drawer-header {
  padding: 1rem;
  border-bottom: 1px solid #eee;
}

.drawer-body {
  flex: 1;
  overflow-y: auto;
  padding: 1rem;
}

.empty-wishlist {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 300px;
}

.drawer-item {
  display: flex;
  gap: 15px;
  margin-bottom: 1rem;
  padding: 1rem;
  border: 1px solid #eee;
  border-radius: 8px;
}

.drawer-item-img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 4px;
}

.drawer-item-details {
  flex: 1;
}

.drawer-item-name {
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.drawer-item-price {
  color: #666;
  margin-bottom: 0.5rem;
}

.drawer-item-actions {
  display: flex;
  gap: 8px;
}
</style>
