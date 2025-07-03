<template>
  <div class="container my-5" v-if="product">
    <div class="row">
      <!-- Product Details -->
      <div class="col-md-12">
        <div class="card mb-4 bg-transparent border-0">
          <div class="row g-0">
            <div class="col-md-5">
              <img :src="selectedImage" :alt="product.title" class="img-fluid rounded-start w-100" />
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{ product.title }}</h3>
                <p class="card-text text-muted">{{ product.description }}</p>
                <h4 class="text-primary mb-3">&#2547; {{ Math.round( product.price * 125 )}}</h4>
                <p v-if="product.discountPercentage" class="mb-2">
                  <span class="badge bg-warning text-dark">-{{ product.discountPercentage }}% OFF</span>
                </p>
                <p class="mb-2">
                  <strong>Category:</strong> {{ product.category }}
                </p>
                <p class="mb-2"><strong>Brand:</strong> {{ product.brand }}</p>
                <p class="mb-2"><strong>Stock:</strong> {{ product.stock }}</p>
                <button class="btn btn-success">Add to Cart</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Product Images Gallery -->
        <div v-if="product.images && product.images.length > 1" class="mb-4">
          <h5>More Images</h5>
          <div class="d-flex flex-wrap gap-2">
            <img v-for="(img, idx) in product.images" :key="idx" :src="img" :alt="product.title" style="
                width: 100px;
                height: 100px;
                object-fit: cover;
                cursor: pointer;
              " class="rounded border" @click="selectedImage = img" />
          </div>
        </div>
      </div>
      <!-- Product Suggestions -->
       
      <div class="col-auto">
        <h5 class="mb-3">You may also like</h5>
        <div class="d-flex justify-content-center align-items-center gap-3">
        <div v-for="suggestion in suggestions" :key="suggestion.id" class="card mb-3">
          <div class="row g-0 align-items-center" style="height: 150px;">
            <div class="col-4">
              <img :src="suggestion.thumbnail || suggestion.images?.[0]" :alt="suggestion.title"
                class="img-fluid rounded" />
            </div>
            <div class="col-8">
              <div class="card-body py-2 px-2">
                <h6 class="card-title mb-1">{{ suggestion.title }}</h6>
                <p class="card-text text-muted small mb-1">
                  &#2547; {{ suggestion.price }}
                </p>
                <router-link :to="{ name: 'productPage', params: { id: suggestion.id } }"
                  class="btn btn-sm btn-outline-primary">View</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div v-else class="container my-5 text-center">
    <div class="spinner-border text-primary" role="status"></div>
    <p class="mt-3">Loading product...</p>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

const route = useRoute();
const product = ref(null);
const allProducts = ref([]);
const suggestions = ref([]);
const selectedImage = ref("");

const fetchProduct = async (id) => {
  // Fetch product details by ID
  const res = await axios.get(`https://dummyjson.com/products/${id}`);
  product.value = res.data;
  selectedImage.value = product.value.thumbnail || product.value.images?.[0];
};

const fetchAllProducts = async () => {
  // Fetch all products for suggestions (limit to 12 for demo)
  const res = await axios.get("https://dummyjson.com/products?limit=12");
  allProducts.value = res.data.products || [];
};

const updateSuggestions = () => {
  // Exclude the current product from suggestions, pick 4 random others
  suggestions.value = allProducts.value
    .filter((p) => p.id !== Number(route.params.id))
    .sort(() => 0.5 - Math.random())
    .slice(0, 4);
};

onMounted(async () => {
  await Promise.all([fetchProduct(route.params.id), fetchAllProducts()]);
  updateSuggestions();
});

watch(
  () => route.params.id,
  async (newId) => {
    await fetchProduct(newId);
    updateSuggestions();
  }
);
</script>

<style scoped>
.card-title {
  font-size: 1.25rem;
}

</style>
