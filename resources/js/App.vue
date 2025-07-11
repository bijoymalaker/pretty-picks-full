<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import ScrollToTop from './components/ScrollToTop.vue'

const props = defineProps({
  title: {
    type: String,
  }
})
</script>

<template>
  <div>
    <Navbar />
    <slot />
    <Footer />
    <ScrollToTop />
  </div>
</template>

<style scoped>
</style>
