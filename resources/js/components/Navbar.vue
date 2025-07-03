<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <RouterLink class="navbar-brand" to="/"><img src="../assets/images/logo/prettypicksLogo.png" alt="" srcset="" class="brand-logo">Pretty Picks</RouterLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/">Home</RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/shop">Shop</RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/about">About</RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/blog">Blog</RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/contact">Contact</RouterLink>
                        </li>
                    </ul>

                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search Products"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <RouterLink class="nav-link position-relative" to="/wishlist">
                                <font-awesome-icon icon="fa-regular fa-heart" class="fs-4" />
                                <span
                                    class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">
                                    10+
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/login">Login/Register</RouterLink>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="#" @click.prevent="openCartDrawer">
                                <font-awesome-icon icon="fa-solid fa-cart-arrow-down" class="fs-4" />
                                <span
                                    class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ cart.length }}
                                    <span class="visually-hidden">cart items</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <CartDrawer />
    </div>
</template>
<script setup>
import { ref, provide } from 'vue'
import CartDrawer from './CartDrawer.vue'

const cart = ref([
    // Example product
    // { name: 'Product 1', qty: 1, price: 20, image: 'https://via.placeholder.com/50' }
])
const cartDrawerOpen = ref(false)

function openCartDrawer() {
    cartDrawerOpen.value = true
}

// Provide cart state and drawer control to children
provide('cart', cart)
provide('cartDrawerOpen', cartDrawerOpen)
provide('setCartDrawerOpen', (val) => { cartDrawerOpen.value = val })

// Example: Add this function to add products to cart from anywhere
function addToCart(product) {
    const found = cart.value.find(item => item.name === product.name)
    if (found) {
        found.qty += 1
    } else {
        cart.value.push({ ...product, qty: 1 })
    }
}
provide('addToCart', addToCart)
</script>
<style scoped>

.brand-logo {
    height: 35px;
    width: 35px;
    margin-right: 10px;
}

</style>