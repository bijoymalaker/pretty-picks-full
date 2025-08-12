<script setup lang="ts">
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayouts from '@/layout/AppLayouts.vue';

interface Blog {
  id: number;
  title: string;
  slug: string;
  excerpt: string;
  content: string;
  featured_image: string | null;
  author: string;
  is_published: boolean;
  meta_title: string;
  meta_description: string;
  tags: string;
}

interface Props {
  blog: Blog;
}

defineOptions({
  layout: AppLayouts,
});

const props = defineProps<Props>();

const form = useForm({
  title: props.blog.title,
  slug: props.blog.slug,
  excerpt: props.blog.excerpt,
  content: props.blog.content,
  author: props.blog.author,
  is_published: props.blog.is_published,
  tags: props.blog.tags,
  meta_title: props.blog.meta_title,
  meta_description: props.blog.meta_description,
  featured_image: null as File | null
});

const imagePreview = ref<string | null>(props.blog.featured_image ? `/storage/${props.blog.featured_image}` : null);

function submit() {
  form.put(`/blogs/${props.blog.id}`, {
    onSuccess: () => {
      router.visit('/blogs');
    }
  });
}

function handleImageUpload(e: Event) {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    form.featured_image = target.files[0];
    
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target?.result as string;
    };
    reader.readAsDataURL(target.files[0]);
  }
}

function removeImage() {
  form.featured_image = null;
  imagePreview.value = null;
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
            <h4 class="mb-0">Edit Blog Post</h4>
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
                  required
                  @blur="generateSlug"
                />
              </div>

              <!-- Slug -->
              <div class="mb-3">
                <label for="slug" class="form-label">Slug *</label>
                <input 
                  id="slug" 
                  v-model="form.slug" 
                  type="text" 
                  class="form-control" 
                  required
                />
              </div>

              <!-- Excerpt -->
              <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea 
                  id="excerpt" 
                  v-model="form.excerpt" 
                  class="form-control" 
                  rows="3"
                ></textarea>
              </div>

              <!-- Content -->
              <div class="mb-3">
                <label for="content" class="form-label">Content *</label>
                <textarea 
                  id="content" 
                  v-model="form.content" 
                  class="form-control" 
                  rows="10"
                  required
                ></textarea>
              </div>

              <!-- Author -->
              <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input 
                  id="author" 
                  v-model="form.author" 
                  type="text" 
                  class="form-control"
                />
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
                  <button type="button" class="btn btn-sm btn-danger mt-1" @click="removeImage">Remove Image</button>
                </div>
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

              <!-- SEO Settings -->
              <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input 
                  id="meta_title" 
                  v-model="form.meta_title" 
                  type="text" 
                  class="form-control"
                />
              </div>

              <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea 
                  id="meta_description" 
                  v-model="form.meta_description" 
                  class="form-control" 
                  rows="2"
                ></textarea>
              </div>

              <!-- Submit Buttons -->
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" :disabled="form.processing">
                  <span v-if="form.processing" class="spinner-border spinner-border-sm me-1"></span>
                  Update Blog Post
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
