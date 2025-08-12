<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div v-if="blog" class="blog-details">
          <h1 class="mb-3">{{ blog.title }}</h1>
          <p class="text-muted mb-4">
            By {{ blog.author }} • {{ new Date(blog.created_at).toLocaleDateString() }}
          </p>
          <img 
            v-if="blog.featured_image" 
            :src="`/storage/${blog.featured_image}`" 
            alt="Featured Image" 
            class="img-fluid mb-4"
            style="max-height: 400px; object-fit: cover; width: 100%;"
          />
          <div class="blog-content" v-html="blog.content"></div>
        </div>
        <div v-else class="text-center">
          <p>Loading blog post...</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import AppLayouts from '../layout/AppLayouts.vue';

defineOptions({
  layout: AppLayouts,
});

const { props } = usePage();
const blog = props.blog || null;
</script>

<style scoped>
.blog-content p {
  line-height: 1.6;
  margin-bottom: 1rem;
}
</style>
