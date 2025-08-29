<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import AppLayouts from '@/layout/AppLayouts.vue';

defineOptions({
  layout: AppLayouts,
});

const props = defineProps({
  products: {
    type: Array,
    required: true
  }
});

const form = useForm({
  name: '',
  description: '',
  price: '',
  collection: '',
  image: null
});

function submit() {
  form.post('/products', { onSuccess: () => form.reset(), forceFormData: true });
}

function handleImageUpload(e) {
  form.image = e.target.files[0];
}

function deleteProduct(productId) {
  if (confirm('Are you sure you want to delete it?')) {
    router.delete(`/products/${productId}`);
  }
}
</script>

<template>
    <div class="container py-5">
      <h1 class="mb-4">Product Management</h1>

      <!-- Add Product Form -->
      <div class="card mb-5">
        <div class="card-header">
          <h5 class="card-title mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="productName" class="form-label">Product Name</label>
                  <input id="productName" v-model="form.name" class="form-control" placeholder="Enter product name" required />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="productPrice" class="form-label">Price</label>
                  <input id="productPrice" v-model="form.price" type="number" step="0.01" class="form-control" placeholder="Enter price" required />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="productCollection" class="form-label">Collection</label>
                  <input id="productCollection" v-model="form.collection" class="form-control" placeholder="Enter collection" />
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="productDescription" class="form-label">Description</label>
              <textarea id="productDescription" v-model="form.description" class="form-control" placeholder="Product description"></textarea>
            </div>
            <div class="mb-3">
              <label for="productImage" class="form-label">Product Image</label>
              <input id="productImage" type="file" @change="handleImageUpload" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </form>
        </div>
      </div>

      <!-- Product List -->
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Product List</h5>
        </div>
        <div class="card-body">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col" v-for="product in products" :key="product.id">
              <div class="card h-100">
                <img v-if="product.image" :src="`/storage/${product.image}`" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                <div v-else class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                  <span class="text-muted">No Image</span>
                </div>
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">{{ product.name }}</h5>
                  <p class="card-text text-muted mb-1">${{ product.price }}</p>
                  <p class="card-text text-muted"><small>Collection: {{ product.collection }}</small></p>
                  <div class="mt-auto d-flex justify-content-end">
                    <Link :href="`/products/${product.id}/edit`" class="btn btn-sm btn-outline-secondary me-2">Edit</Link>
                    <button @click="deleteProduct(product.id)" type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
