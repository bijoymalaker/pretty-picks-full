<template>
    <div>
        <InnerPageBanner :innerBanner="blogBanner"  />
        <div class="container my-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <h1 class="text-center mb-5">Our Blog</h1>
                    <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'user'" class="text-end mb-3">
                        <Link :href="route('blogs.index')" class="btn btn-primary text-center">
                        <i class="bi bi-plus"></i> Manage Blog
                    </Link>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" v-for="blog in blogs" :key="blog.id">
                    <div class="card h-100">
                        <img 
                            v-if="blog.featured_image" 
                            :src="`/storage/${blog.featured_image}`" 
                            class="card-img-top" 
                            :alt="blog.title"
                            style="height: 200px; object-fit: cover;"
                        >
                        <div v-else class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">No Image</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ blog.title }}</h5>
                            <p class="text-muted">
                                <small>By {{ blog.author }} • {{ new Date(blog.created_at).toLocaleDateString() }}</small>
                            </p>
                            <p class="card-text">{{ blog.excerpt || blog.content.substring(0, 150) + '...' }}</p>
                            <Link :href="`/blog/${blog.slug}`" class="btn btn-primary">Read More</Link>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="blogs.length === 0" class="text-center py-5">
                <h3>No blog posts yet</h3>
                <p>Check back soon for new content!</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import InnerPageBanner from '../components/innerpage/InnerPageBanner.vue';
import innerBanner from '../assets/images/BlackWeddingJewelryLandscap.png';
import AppLayouts from '@/layout/AppLayouts.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineOptions({
    layout: AppLayouts,
});

const props = defineProps({
  blogs: {
    type: Array,
    default: () => []
  }
});

const blogBanner = innerBanner;
</script>
<style scoped>
</style>
