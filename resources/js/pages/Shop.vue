<template>
    <div>
        <InnerPageBanner :innerBanner="innerBanner" />
        <div class="container my-4">
            <div class="d-block d-md-none mb-3">
                <select class="form-select" v-model="selectedCategory" @change="selectCategory(selectedCategory)">
                    <option v-for="(category, index) in categories" :key="index" :value="category">
                        {{ category }}
                    </option>
                </select>
            </div>
            <ul class="nav nav-tabs justify-content-center d-none d-md-flex">
                <li class="nav-item" v-for="(category, index) in categories" :key="index">
                    <a class="nav-link text-capitalize" :class="{ active: selectedCategory === category }" href="#"
                        @click.prevent="selectCategory(category)">{{ category }}</a>
                </li>
            </ul>
        </div>
        <div class="container my-4">
            <div class="row">
                <!-- Sidebar -->
                <aside class="col-md-3">
                    <div class="mb-4">
                        <h5>Filter by Price</h5>
                        <div>
                            <label>Min Price: ${{ priceRange[0] }}</label>
                            <input type="range" class="form-range" min="0" max="2000" step="50" v-model="priceRange[0]" />
                        </div>
                        <div>
                            <label>Max Price: ${{ priceRange[1] }}</label>
                            <input type="range" class="form-range" min="0" max="2000" step="50" v-model="priceRange[1]" />
                        </div>
                        <p>Price Range: ${{ priceRange[0] }} - ${{ priceRange[1] }}</p>
                    </div>
                    <div class="mb-4">
                        <h5>Stock Status</h5>
                        <div>
                            <input type="checkbox" id="onSale" v-model="filters.onSale" />
                            <label for="onSale">On Sale</label>
                        </div>
                        <div>
                            <input type="checkbox" id="inStock" v-model="filters.inStock" />
                            <label for="inStock">In Stock</label>
                        </div>
                    </div>
                    <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'">
                        <Link :href="route('products.index')" class="btn btn-primary w-100">Manage Products</Link>
                    </div>
                    
                </aside>
                <!-- Main Content -->
                <main class="col-md-9">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        <div class="col" v-for="product in filteredProducts" :key="product.id">
                            <div class="card h-100">
                                <img :src="getProductImage(product)" class="card-img-top" :alt="product.name" />
                                <div class="card-body">
                                    <h5 class="card-title">{{ product.name }}</h5>
                                    <p class="card-text text-capitalize">{{ product.collection || 'Uncategorized' }}</p>
                                    <p class="text-muted">
                                        ${{ Math.floor(Number(product.price)) }}
                                    </p>
                                    <div class="d-flex gap-2">
                                        <Link :href="route('productPage', { id: product.id })" class="btn btn-primary btn-sm flex-fill">View Details</Link>
                                        <button class="btn btn-outline-primary btn-sm" @click="addToCart(product)">
                                            <FontAwesomeIcon icon="fa-solid fa-cart-plus" />
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" @click="addToWishlist(product)">
                                            <FontAwesomeIcon icon="fa-regular fa-heart" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
<script setup>
import AppLayout from '@/layout/AppLayouts.vue';
import { ref, computed } from "vue";
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import InnerPageBanner from "../components/innerpage/InnerPageBanner.vue";
import innerBanner from '../assets/images/shop-banner.jpg';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { useCartStore } from '@/stores/cart';
import { useWishlistStore } from '@/stores/wishlist';

defineOptions({
  name: 'Shop',
  layout: AppLayout,
})

// Props from backend
const props = defineProps({
  products: {
    type: Array,
    required: true
  }
});

// Use cart and wishlist stores
const cartStore = useCartStore();
const wishlistStore = useWishlistStore();

const addToCart = (product) => {
    cartStore.addToCart(product);
};

const addToWishlist = (product) => {
    wishlistStore.addToWishlist(product);
};

const priceRange = ref([0, 2000]);
const filters = ref({
    onSale: false,
    inStock: false,
});

// Categories based on collections from backend
const categories = computed(() => {
    const allCollections = props.products.map((product) => product.collection || 'Uncategorized');
    const uniqueCollections = [...new Set(allCollections)];
    return ['All', ...uniqueCollections.filter(Boolean)];
});

const selectedCategory = ref('All');

function selectCategory(category) {
    selectedCategory.value = category;
}

const getProductImage = (product) => {
    if (product.image) {
        return `/storage/${product.image}`;
    }
    return 'https://via.placeholder.com/300x200?text=No+Image';
};

const filteredProducts = computed(() => {
    let filtered = props.products;
    
    // Category filter (using collection as category)
    if (selectedCategory.value !== "All") {
        filtered = filtered.filter((product) => 
            (product.collection || 'Uncategorized').toLowerCase() === selectedCategory.value.toLowerCase()
        );
    }
    
    // Price range filter
    filtered = filtered.filter((product) => {
        const price = typeof product.price === 'string' ? parseFloat(product.price) : product.price;
        return price >= priceRange.value[0] && price <= priceRange.value[1];
    });
    
    // Stock status filters - simplified for now
    if (filters.value.inStock) {
        // For now, assume all products are in stock
        filtered = filtered.filter(() => true);
    }
    
    if (filters.value.onSale) {
        // For now, assume no products are on sale
        filtered = filtered.filter(() => false);
    }
    
    return filtered;
});
</script>
<style scoped>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.badge {
    font-size: 0.75em;
}
</style>
