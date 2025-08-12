<script setup lang="ts">
import { ref } from 'vue';
import { Link, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  products: Array
});

const form = useForm({
  name: '',
  description: '',
  price: '',
  image: null
});

function submit() {
  form.post('/products', { onSuccess: () => form.reset() });
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
  <div>
    <h1 class="text-2xl font-bold mb-4">Product Management</h1>

    <!-- Add Product -->
    <form @submit.prevent="submit" class="mb-6">
      <input v-model="form.name" placeholder="Product Name" required />
      <textarea v-model="form.description" placeholder="Description"></textarea>
      <input v-model="form.price" type="number" placeholder="Price" required />
      <input type="file" @change="handleImageUpload" />
      <button type="submit">Add Product</button>
    </form>

    <!-- Product List -->
    <table border="1">
      <thead>
        <tr>
          <th>Image</th><th>Name</th><th>Price</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>
            <img v-if="product.image" :src="`/storage/${product.image}`" width="50" />
          </td>
          <td>{{ product.name }}</td>
          <td>{{ product.price }}</td>
          <td>
            <!-- Edit and Delete -->
            <Link :href="`/products/${product.id}/edit`">Edit</Link>
            <button @click="deleteProduct(product.id)" type="button">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>