<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <Link class="navbar-brand" :href="route('home')">
                <img src="../assets/images/logo/prettypicksLogo.png" alt="" class="brand-logo">
                Pretty Picks
                </Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav ms-2">
                        <li class="nav-item" v-for="item in navItems" :key="item.name">
                            <Link class="nav-link" :href="route(item.route)" :class="{ active: isActive(item.route) }">
                            {{ item.label }}
                            </Link>
                        </li>
                    </ul>

                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search Products"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav ms-2">
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="#" @click.prevent="openWishlistDrawer">
                                <FontAwesomeIcon icon="fa-regular fa-heart" class="fs-4" />
                                <span
                                    class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ wishlistStore.wishlistItemsCount }}
                                    <span class="visually-hidden">wishlist items</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="route('admin.login')" :class="{ active: isActive('admin.login') }">
                            Admin Login</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="route('login')" :class="{ active: isActive('login') }">
                            Login/Register</Link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="#" @click.prevent="openCartDrawer">
                                <FontAwesomeIcon icon="fa-solid fa-cart-arrow-down" class="fs-4" />
                                <span
                                    class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ cartStore.cartItemsCount }}
                                    <span class="visually-hidden">cart items</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <CartDrawer ref="cartDrawerRef" />
        <WishlistDrawer ref="wishlistDrawerRef" />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import CartDrawer from './CartDrawer.vue'
import WishlistDrawer from './WishlistDrawer.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useCartStore } from '../stores/cart'
import { useWishlistStore } from '../stores/wishlist'

const page = usePage()
function isActive(routeName) {
  // Compare the current route name from Ziggy with the nav item route name
  return page.props.value?.ziggy?.route?.name === routeName;
}

// Initialize stores
const cartStore = useCartStore()
const wishlistStore = useWishlistStore()

// Drawer refs
const cartDrawerRef = ref(null)
const wishlistDrawerRef = ref(null)

function openCartDrawer() {
    cartDrawerRef.value?.openDrawer()
}

function openWishlistDrawer() {
    wishlistDrawerRef.value?.openDrawer()
}

const navItems = [
    { name: 'home', route: 'home', label: 'Home' },
    { name: 'shop', route: 'shop', label: 'Shop' },
    { name: 'about', route: 'about', label: 'About' },
    { name: 'blog', route: 'blog', label: 'Blog' },
    { name: 'contact', route: 'contact', label: 'Contact' },
]
</script>

<style scoped>
.brand-logo {
    height: 35px;
    width: 35px;
    margin-right: 10px;
}

.nav-link.active {
    color: #ff2222 !important;
    font-weight: bold;
}
</style>
