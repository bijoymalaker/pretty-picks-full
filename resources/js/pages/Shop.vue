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
                        <input type="range" class="form-range" min="400" max="2200" step="100" v-model="priceRange" />
                        <p>Price: {{ priceRange[0] }} - {{ priceRange[1] }}</p>
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
                </aside>
                <!-- Main Content -->
                <main class="col-md-9">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        <div class="col" v-for="product in filteredProducts" :key="product.id">
                            <div class="card h-100">
                                <img :src="product.images" class="card-img-top" :alt="product.title" />
                                <div class="card-body">
                                    <button @click="console.log(product)" class="btn btn-secondary btn-sm mb-2">Show in
                                        Console</button>
                                    <h5 class="card-title">{{ product.title }}</h5>
                                    <p class="card-text">{{ product.category }}</p>
                                    <p class="text-muted">
                                        <s v-if="product.discount">&#2547; {{ Math.floor(product.originalPrice * 125) }}</s>
                                        &#2547; {{ Math.floor(product.price * 125) }}
                                    </p>
                                    <router-link :to="{ name: 'productPage', params: { id: product.id } }"
                                        class="btn btn-primary">Read More</router-link>
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
import { ref, onMounted, computed } from "vue";
import InnerPageBanner from "../components/innerpage/InnerPageBanner.vue";
import innerBanner from '../assets/images/with_photosWeb_Banner_716_4jjhhj.webp';

const priceRange = ref([400, 2200]);
const products = ref([]);
const filters = ref({
    onSale: false,
    inStock: false,
});

// Add "All" as the first category
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
    if (selectedCategory.value === "All") {
        return products.value;
    }
    return products.value.filter(product => product.category === selectedCategory.value);
});
</script>
<style scoped></style>
