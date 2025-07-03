<template>
  <div v-if="isOpen || isClosing" class="wishlist-drawer-backdrop" @click.self="closeDrawer">
    <div :class="['wishlist-drawer', isClosing ? 'slide-out' : 'slide-in']">
      <div class="drawer-header d-flex justify-content-between align-items-center">
        <h5>Your Wishlist</h5>
        <button class="btn-close" @click="closeDrawer"></button>
      </div>
      <div class="drawer-body">
        <div v-if="wishlist.length === 0">Your wishlist is empty.</div>
        <div v-for="(item, idx) in wishlist" :key="idx" class="drawer-item">
          <img :src="item.image" alt="" class="drawer-item-img" />
          <div>
            <div>{{ item.name }}</div>
            <div>Price: ${{ item.price }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject, ref, watch } from 'vue'
const wishlist = inject('wishlist')
const isOpen = inject('wishlistDrawerOpen')
const setDrawerOpen = inject('setWishlistDrawerOpen')

const isClosing = ref(false)

function closeDrawer() {
  isClosing.value = true
  setTimeout(() => {
    setDrawerOpen(false)
    isClosing.value = false
  }, 300)
}

watch(isOpen, (val) => {
  if (val) isClosing.value = false
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
  width: 350px;
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
.drawer-item {
  display: flex;
  gap: 10px;
  margin-bottom: 1rem;
}
.drawer-item-img {
  width: 50px;
  height: 50px;
  object-fit: cover;
}
</style>