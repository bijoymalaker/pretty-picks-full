<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import { watch } from 'vue'
import AppLayouts from '@/layout/AppLayouts.vue';

defineOptions({
  layout: AppLayouts,
});

const props = defineProps({
  product: {
    type: Object,
    required: true
  }
})

const form = useForm({
  name: props.product.name,
  description: props.product.description,
  price: props.product.price,
  collection: props.product.collection,
  image: null
})

watch(() => props.product, (newProduct) => {
  form.name = newProduct.name
  form.description = newProduct.description
  form.price = newProduct.price
  form.collection = newProduct.collection
})

function handleFileChange(e) {
  form.image = e.target.files[0]
}

function updateProduct() {
  form.transform((data) => ({
    ...data,
    _method: 'PUT' // Laravel method spoofing
  }))
  .post(`/products/${props.product.id}`, {
    forceFormData: true, // sends as multipart/form-data
    onSuccess: () => {
      // You might want a more elegant notification here
      alert('Product updated successfully')
      // Optionally redirect back to products list
      window.location.href = '/products'
    },
    onError: (errors) => {
      console.error('Update failed:', errors)
      // Errors will be automatically displayed on the form fields
      alert('Failed to update product. Please check the console for errors.');
    }
  })
}
</script>

<template>

    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Edit Product</h1>
            <Link href="/products" class="btn btn-outline-secondary">Back to Products</Link>
          </div>

          <div class="card">
            <div class="card-body">
              <form @submit.prevent="updateProduct" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="productName" class="form-label">Product Name</label>
                      <input id="productName" v-model="form.name" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="productPrice" class="form-label">Price</label>
                      <input id="productPrice" v-model="form.price" type="number" step="0.01" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="productCollection" class="form-label">Collection</label>
                  <input id="productCollection" v-model="form.collection" type="text" class="form-control">
                </div>

                <div class="mb-3">
                  <label for="productDescription" class="form-label">Description</label>
                  <textarea id="productDescription" v-model="form.description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                  <label for="productImage" class="form-label">Product Image</label>
                  <input id="productImage" type="file" @change="handleFileChange" class="form-control">
                  <div v-if="product.image && !form.image" class="mt-3">
                    <p class="mb-1">Current Image:</p>
                    <img :src="`/storage/${product.image}`" alt="Product Image" class="img-thumbnail" width="150">
                  </div>
                </div>

                <!-- Display validation errors -->
                <div v-if="Object.keys(form.errors).length > 0" class="alert alert-danger mt-3">
                  <h6 class="alert-heading">Please fix the following errors:</h6>
                  <ul class="mb-0">
                    <li v-for="(error, field) in form.errors" :key="field">
                      <strong>{{ field }}:</strong> {{ error }}
                    </li>
                  </ul>
                </div>

                <button type="submit" class="btn btn-primary mt-3" :disabled="form.processing">
                  <span v-if="form.processing">Updating...</span>
                  <span v-else>Update Product</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
