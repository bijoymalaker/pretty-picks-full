<script setup lang="ts">
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayouts from '@/layout/AppLayouts.vue';

defineOptions({
  layout: AppLayouts,
});

const form = useForm({
  title: '',
  slug: '',
  excerpt: '',
  content: '',
  author: 'Admin',
  is_published: false,
  tags: '',
  meta_title: '',
  meta_description: '',
  featured_image: null
});

const imagePreview = ref<string | null>(null);

function submit() {
  form.post('/blogs', {
    onSuccess: () => {
      router.visit('/blogs');
    }
  });
}

function handleImageUpload(e: Event) {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    form.featured_image = target.files[0];
    
    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target?.result as string;
    };
    reader.readAsDataURL(target.files[0]);
  }
}

function generateSlug() {
  if (form.title && !form.slug) {
    form.slug = form.title
      .toLowerCase()
      .replace(/[^\w\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .trim();
  }
}
</script>

<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-0">Create New Blog Post</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="submit" enctype="multipart/form-data">
              <!-- Title -->
              <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input 
                  id="title" 
                  v-model="form.title" 
                  type="text" 
                  class="form-control" 
                  placeholder="Enter blog title"
                  @blur="generateSlug"
                  required
                />
                <div v-if="form.errors.title" class="text-danger small mt-1">
                  {{ form.errors.title }}
                </div>
              </div>

              <!-- Slug -->
              <div class="mb-3">
                <label for="slug" class="form-label">Slug *</label>
                <input 
                  id="slug" 
                  v-model="form.slug" 
                  type="text" 
                  class="form-control" 
                  placeholder="blog-post-slug"
                  required
                />
                <div class="form-text">URL-friendly version of the title</div>
                <div v-if="form.errors.slug" class="text-danger small mt-1">
                  {{ form.errors.slug }}
                </div>
              </div>

              <!-- Excerpt -->
              <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea 
                  id="excerpt" 
                  v-model="form.excerpt" 
                  class="form-control" 
                  rows="3"
                  placeholder="Brief description of the blog post"
                ></textarea>
                <div v-if="form.errors.excerpt" class="text-danger small mt-1">
                  {{ form.errors.excerpt }}
                </div>
              </div>

              <!-- Content -->
              <div class="mb-3">
                <label for="content" class="form-label">Content *</label>
                <textarea 
                  id="content" 
                  v-model="form.content" 
                  class="form-control" 
                  rows="10"
                  placeholder="Write your blog content here..."
                  required
                ></textarea>
                <div v-if="form.errors.content" class="text-danger small mt-1">
                  {{ form.errors.content }}
                </div>
              </div>

              <!-- Author -->
              <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input 
                  id="author" 
                  v-model="form.author" 
                  type="text" 
                  class="form-control" 
                  placeholder="Author name"
                />
              </div>

              <!-- Tags -->
              <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input 
                  id="tags" 
                  v-model="form.tags" 
                  type="text" 
                  class="form-control" 
                  placeholder="tag1, tag2, tag3"
                />
                <div class="form-text">Comma-separated tags</div>
              </div>

              <!-- Featured Image -->
              <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input 
                  id="featured_image" 
                  type="file" 
                  class="form-control" 
                  accept="image/*"
                  @change="handleImageUpload"
                />
                <div v-if="imagePreview" class="mt-2">
                  <img :src="imagePreview" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                </div>
                <div v-if="form.errors.featured_image" class="text-danger small mt-1">
                  {{ form.errors.featured_image }}
                </div>
              </div>

              <!-- SEO Settings -->
              <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input 
                  id="meta_title" 
                  v-model="form.meta_title" 
                  type="text" 
                  class="form-control" 
                  placeholder="SEO title"
                />
              </div>

              <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea 
                  id="meta_description" 
                  v-model="form.meta_description" 
                  class="form-control" 
                  rows="2"
                  placeholder="SEO description"
                ></textarea>
              </div>

              <!-- Publish Status -->
              <div class="mb-3">
                <div class="form-check">
                  <input 
                    id="is_published" 
                    v-model="form.is_published" 
                    type="checkbox" 
                    class="form-check-input"
                  >
                  <label for="is_published" class="form-check-label">
                    Publish immediately
                  </label>
                </div>
              </div>

              <!-- Submit Buttons -->
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" :disabled="form.processing">
                  <span v-if="form.processing" class="spinner-border spinner-border-sm me-1"></span>
                  Create Blog Post
                </button>
                <button type="button" class="btn btn-secondary" @click="router.visit('/blogs')">
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
