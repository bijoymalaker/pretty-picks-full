<template>
  <div>
    <h1>Edit Product</h1>
    <form @submit.prevent="updateProduct">
      <div>
        <label>Name</label>
        <input v-model="form.name" type="text">
      </div>
      <div>
        <label>Description</label>
        <textarea v-model="form.description"></textarea>
      </div>
      <div>
        <label>Price</label>
        <input v-model="form.price" type="number" step="0.01">
      </div>
      <div>
        <label>Image</label>
        <input type="file" @change="handleFileChange">
        <div v-if="product.image">
          <img :src="`/storage/${product.image}`" alt="Product Image" width="100">
        </div>
      </div>
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { watch } from 'vue'

const props = defineProps({
  product: Object
})

const form = useForm({
  name: props.product.name,
  description: props.product.description,
  price: props.product.price,
  image: null
})

watch(() => props.product, (newProduct) => {
  form.name = newProduct.name
  form.description = newProduct.description
  form.price = newProduct.price
})

function handleFileChange(e) {
  form.image = e.target.files[0]
}

function updateProduct() {
  form.post(`/products/${props.product.id}`)
}
</script>
