<template>
    <div>
        <InnerPageBanner :innerBanner="blogBanner"  />
        <div class="container my-4">
            <div class="row">
                <div class="col-md-4 mb-4" v-for="post in articles" :key="post.id">
                    <div class="card">
                        <img :src="post.image" class="card-img-top" :alt="post.title">
                        <div class="card-body">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="text-muted">Posted on {{ post.date }}</p>
                            <p class="card-text">{{ post.summary }}</p>
                            <router-link :to="{ name: 'blogPost', params: { id: post.id } }" class="btn btn-primary" @click.native="scrollToTop" >Read More</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import InnerPageBanner from '../components/innerpage/InnerPageBanner.vue';
import innerBanner from '../assets/images/BlackWeddingJewelryLandscap.png';
import { articles } from '../assets/blogs/blogs.js'; // Assuming you have a file with articles data

export default {
    name: 'BlogPage',
    components: {
        InnerPageBanner,
        articles,
    },
    data() {
        return {
            blogBanner: innerBanner,
            blogTitle: 'Blog',
            blogFooter: 'Pretty Picks. All Rights Reserved.',
            articles: articles, // Assuming articles.js exports an array of article objects
        };
    },
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
    },
};
</script>
<style scoped>
</style>
