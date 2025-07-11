<template>
    <Navbar />

    <slot />
    
    <ScrollToTop />

    <Footer />




</template>

<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import ScrollToTop from './components/ScrollToTop.vue'

</style>