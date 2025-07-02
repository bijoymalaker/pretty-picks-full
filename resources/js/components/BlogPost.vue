<template>
  <div class="blogpost-hero position-relative mb-5" v-if="blog">
    <img :src="blog.image" :alt="blog.title" class="w-100 hero-img" />
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start px-5">
      <h1 class="text-white display-5 fw-bold mb-3 hero-title">{{ blog.title }}</h1>
      <div class="text-white mb-2">
        <span><font-awesome-icon icon="fa-regular fa-user" /> {{ blog.author }}</span>
        <span class="mx-2">|</span>
        <span><font-awesome-icon icon="fa-regular fa-calendar" /> {{ blog.date }}</span>
        <span class="mx-2">|</span>
        <span><font-awesome-icon icon="fa-regular fa-comments" /> 0 comments</span>
      </div>
      <div class="text-white mb-2">
        <span class="badge bg-light text-dark">{{ blog.category }}</span>
      </div>
    </div>
  </div>
  <div class="container my-5" v-if="blog">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="blog-content" v-html="blog.content"></div>
        <div class="d-flex justify-content-between align-items-center mt-4">
          <div>
            <span class="badge bg-light text-dark me-2" v-for="tag in blog.tags" :key="tag">{{ tag }}</span>
          </div>
          <div>
            <span class="me-3"><font-awesome-icon icon="fa-solid fa-share" /> Share</span>
            <span class="me-3"><font-awesome-icon icon="fa-brands fa-twitter" /> Tweet</span>
            <span><font-awesome-icon icon="fa-solid fa-print" /> Print</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Related Blogs -->
    <div class="mt-5" v-if="relatedBlogs.length">
      <h4 class="mb-4">Related Posts</h4>
      <div class="row">
        <div v-for="related in relatedBlogs" :key="related.id" class="col-md-3 mb-4">
          <div class="card h-100">
            <img :src="related.image" :alt="related.title" class="card-img-top" style="height: 300px; object-fit: cover;" />
            <div class="card-body">
              <h6 class="card-title">{{ related.title }}</h6>
              <p class="card-text text-muted small mb-1">{{ related.summary }}</p>
              <router-link :to="{ name: 'blogPost', params: { id: related.id } }" class="btn btn-sm btn-outline-primary" @click.native="scrollToTop">Read More</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="container my-5 text-center">
    <div class="spinner-border text-primary" role="status"></div>
    <p class="mt-3">Loading blog post...</p>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import { articles } from "../assets/blogs/blogs"; // Adjust the path if needed

const route = useRoute();
const blog = ref(null);
const allBlogs = ref([]);
const relatedBlogs = ref([]);

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

const fetchBlog = (id) => {
  const found = articles.find(b => String(b.id) === String(id));
  blog.value = found || null;
};

const fetchAllBlogs = () => {
  allBlogs.value = articles;
};

const updateRelatedBlogs = () => {
  relatedBlogs.value = allBlogs.value
    .filter(b => String(b.id) !== String(route.params.id))
    .sort(() => 0.5 - Math.random())
    .slice(0, 4);
};

onMounted(() => {
  fetchAllBlogs();
  fetchBlog(route.params.id);
  updateRelatedBlogs();
});

watch(() => route.params.id, (newId) => {
  fetchBlog(newId);
  updateRelatedBlogs();
});
</script>

<style scoped>
.blogpost-hero {
  height: 420px;
  overflow: hidden;
  position: relative;
  margin-bottom: 2rem;
}
.hero-img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  object-position: center;
}
.hero-overlay {
  background: linear-gradient(90deg, rgba(0,0,0,0.55) 60%, rgba(0,0,0,0.1) 100%);
  color: #fff;
  left: 0;
  top: 0;
  height: 100%;
}
.hero-title {
  text-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.blog-content {
  font-size: 1.1rem;
  line-height: 1.7;
}
.card-title {
  font-size: 1.1rem;
}
.breadcrumb {
  background: none;
  padding: 0;
  margin-bottom: 1rem;
}
</style>