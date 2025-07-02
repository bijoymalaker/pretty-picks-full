<template>
  <footer class="bg-light py-4 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="d-flex align-items-center mb-3">
            <img :src="logo" alt="Shop Logo" height="50" class="me-2" />
            <h5 class="mb-0 fs-4">Pretty Picks</h5>
          </div>
          <ul class="list-unstyled text-muted small fs-5">
            <li>
              <address><font-awesome-icon icon="fa-solid fa-location-dot" class="me-2" />Dhaka, Bangladesh</address>
            </li>
            <li>
              <a href="tel:+8801839211732" class=" text-decoration-none text-black-50"><font-awesome-icon icon="fa-solid fa-phone" class="me-2" />Phone:
              01029794605</a>
            </li>
            <li>
              <font-awesome-icon icon="fa-brands fa-whatsapp" class="me-2" />Whatsapp: 01823934468
            </li>
          </ul>
        </div>
        <div class="col-md-4 offset-md-4">
          <h6 class="mb-3">RECENT POSTS</h6>
          <ul class="list-unstyled">
            <li v-for="post in articles.slice(0, 3)" :key="post.id" class="mb-2">
              <router-link :to="`/blog/${post.id}`" class="text-decoration-none text-dark" @click.native="scrollToTop">
                <div class="d-flex align-items-start">
                  <img :src="post.image" :alt="post.title" height="50" class="me-2 rounded" />
                  <div>
                    <a href="#" class="text-decoration-none text-dark fw-bold small">{{ post.title }}</a><br />
                    <span class="text-muted small">{{ post.date }}</span>
                  </div>
                </div>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
      <div class="row mt-4 border-top pt-3">
        <div class="col-md-6">
          <p class="text-muted small mb-0">
            All Rights Reserved by
            <router-link to="/" @click.native="scrollToTop">Pretty Picks</router-link>
          </p>
        </div>
        <div class="col-md-6 text-end">
          <img :src="paymentImage" alt="Payment Methods" height="50%" class="mw-100" />
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref, onMounted } from "vue";
import logo from "../assets/images/logo/prettypicksLogo.png";
import paymentImage from "../assets/images/paymentssl.png";

import axios from "axios";
const articles = ref([]);

onMounted(async () => {
  const response = await axios.get("/src/assets/blogs/blogs.json");
  articles.value = response.data;
});

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}

</script>

<style scoped></style>
