<script>
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import ScrollToTop from './components/ScrollToTop.vue';

export default {
  name: 'App',
  data() {
    return {
      
    }
  },
  components: {
    Navbar, Footer, ScrollToTop
  },
  computed: {
    isAuthPage() {
      const authPages = ['/login', '/register'];
      return authPages.includes(this.$route.path);
    }
  }
};
</script>

<template>
  <div>
    <template v-if="!isAuthPage">
      <Navbar />
    </template>
    <router-view />
    <template v-if="!isAuthPage">
      <Footer />
      <ScrollToTop />
    </template>
    
    </div>
</template>

<style scoped>

</style>
