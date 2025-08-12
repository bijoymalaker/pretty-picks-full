<template>
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Blog Management</h1>
      <Link href="/blogs/create" class="btn btn-primary">Create New Blog</Link>
    </div>

    <!-- Blog List -->
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Blog Posts</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="blog in blogs" :key="blog.id">
                <td>
                  <img 
                    v-if="blog.featured_image" 
                    :src="`/storage/${blog.featured_image}`" 
                    alt="Blog image" 
                    class="img-thumbnail" 
                    style="width: 60px; height: 60px; object-fit: cover;"
                  >
                  <div v-else class="bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <span class="text-muted">No Image</span>
                  </div>
                </td>
                <td>
                  <strong>{{ blog.title }}</strong>
                  <br>
                  <small class="text-muted">{{ blog.slug }}</small>
                </td>
                <td>{{ blog.author }}</td>
                <td>
                  <span :class="['badge', blog.is_published ? 'bg-success' : 'bg-warning']">
                    {{ blog.is_published ? 'Published' : 'Draft' }}
                  </span>
                </td>
                <td>{{ new Date(blog.created_at).toLocaleDateString() }}</td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <Link :href="`/blogs/${blog.id}/edit`" class="btn btn-outline-primary">Edit</Link>
                    <button @click="togglePublish(blog)" class="btn btn-outline-info">
                      {{ blog.is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                    <button @click="deleteBlog(blog.id)" class="btn btn-outline-danger">Delete</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayouts from '@/layout/AppLayouts.vue';

defineOptions({
  layout: AppLayouts,
});

const props = defineProps({
  blogs: Array
});

function deleteBlog(blogId) {
  if (confirm('Are you sure you want to delete this blog post?')) {
    router.delete(`/blogs/${blogId}`);
  }
}

function togglePublish(blog) {
  router.patch(`/blogs/${blog.id}/toggle-publish`, {
    is_published: !blog.is_published
  });
}
</script>
