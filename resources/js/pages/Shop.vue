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
                    <Link :href="route('products.index')" class="btn btn-primary w-100">Manage Products</Link>
                </aside>
                <!-- Main Content -->
                <main class="col-md-9">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        <div class="col" v-for="product in filteredProducts" :key="product.id">
                            <div class="card h-100">
                                <img :src="getProductImage(product)" class="card-img-top" :alt="product.title" />
                                <div class="card-body">
                                    <h5 class="card-title">{{ product.title }}</h5>
                                    <p class="card-text text-capitalize">{{ product.category }}</p>
                                    <p class="text-muted">
                                        <s v-if="product.discountPercentage > 0">
                                            ${{ Math.floor(product.price / (1 - product.discountPercentage / 100)) }}
                                        </s>
                                        ${{ Math.floor(product.price) }}
                                        <span v-if="product.discountPercentage > 0" class="badge bg-success">
                                            {{ product.discountPercentage }}% OFF
                                        </span>
                                    </p>
                                    <Link :href="route('productPage', { id: product.id })" class="btn btn-primary btn-sm">View Details</Link>
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
defineOptions({
  name: 'Shop',
  layout: AppLayout,
})
import { ref, onMounted, computed } from "vue";
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import InnerPageBanner from "../components/innerpage/InnerPageBanner.vue";
import innerBanner from '../assets/images/with_photosWeb_Banner_716_4jjhhj.webp';

const priceRange = ref([0, 2000]);
const products = ref([]);
const filters = ref({
    onSale: false,
    inStock: false,
});

// Categories matching dummyjson.com
const categories = [
    "All",
    "beauty",
    "womens-bags",
    "womens-dresses",
    "womens-jewellery",
    "womens-shoes",
    "womens-watches",
];

const selectedCategory = ref(categories[0]);

function selectCategory(category) {
    selectedCategory.value = category;
}

const getProductImage = (product) => {
    if (product.images && Array.isArray(product.images) && product.images.length > 0) {
        return product.images[0];
    }
    return 'https://via.placeholder.com/300x200?text=No+Image';
};

const fetchProducts = async () => {
    try {
        const allProducts = [];
        // Skip "All" when fetching
        for (const category of categories.slice(1)) {
            const response = await fetch(
                `https://dummyjson.com/products/category/${category}`
            );
            const data = await response.json();
            if (data.products) {
                allProducts.push(...data.products);
            }
        }
        products.value = allProducts;
    } catch (error) {
        console.error("Error Fetching products", error);
    }
};

onMounted(fetchProducts);

const filteredProducts = computed(() => {
    let filtered = products.value;
    
    // Category filter
    if (selectedCategory.value !== "All") {
        filtered = filtered.filter(product => 
            product.category.toLowerCase() === selectedCategory.value.toLowerCase()
        );
    }
    
    // Price range filter
    filtered = filtered.filter(product => 
        product.price >= priceRange.value[0] && product.price <= priceRange.value[1]
    );
    
    // Stock status filters
    if (filters.value.onSale) {
        filtered = filtered.filter(product => product.discountPercentage > 0);
    }
    
    if (filters.value.inStock) {
        filtered = filtered.filter(product => product.availabilityStatus === 'InStock');
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
<style scoped></style>
