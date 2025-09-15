<template>
    <div class="container mt-4">
    <h2>Add Product</h2>
    <form @submit.prevent="addProduct" class="mb-4" method="post">
      <div class="mb-2">
        <input v-model="form.name" class="form-control" placeholder="Product Name" required />
      </div>
      <div class="mb-2">
        <input v-model.number="form.price" type="number" class="form-control" placeholder="Price" required />
      </div>
      <div class="mb-2">
        <input v-model="form.image" class="form-control" placeholder="Image URL (optional)" />
      </div>
      <button class="btn btn-success" type="submit">Add Product</button>
      <div v-if="error" class="alert alert-danger mt-2">{{ error }}</div>
    </form>

    <h2>Products</h2>
    <div v-if="products.length === 0" class="alert alert-info">
      No products here
    </div>
    <div class="row" v-else>
      <div v-for="product in products" :key="product.id" class="col-md-3 mb-3">
        <div class="card">
          <img v-if="product.image" :src="product.image" class="card-img-top" style="height:150px;object-fit:cover;" />
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">৳{{ product.price }}</p>
          </div>
        </div>
      </div>
    </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const form = ref({ name: '', price: '', image: '' })
const products = ref([])
const error = ref('')

async function fetchProducts() {
  try {
    const res = await axios.get('/api/products') // Use correct API endpoint
    products.value = res.data
  } catch (e) {
    error.value = 'Failed to fetch products.'
  }
}

async function addProduct() {
  error.value = ''
  try {
    // Ensure price is a number
    const payload = { ...form.value, price: Number(form.value.price) }
    await axios.post('/api/products', payload) // Use correct API endpoint
    form.value = { name: '', price: '', image: '' }
    await fetchProducts()
  } catch (e) {
    if (e.response && e.response.data && e.response.data.message) {
      error.value = e.response.data.message
    } else {
      error.value = 'Failed to add product.'
    }
  }
}

onMounted(fetchProducts)
  components: {
    AppLayouts
  }
</script>