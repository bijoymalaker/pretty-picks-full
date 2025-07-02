<template>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center">
                    <h2 class="display-6 fw-bold mb-3">OUR ARTICLE</h2>
                    <p class="mb-5 text-muted">
                        Majority have suffered alteration in some form, by injected humour,
                        or randomised words which don't look even slightly believable.
                    </p>
                </div>

                <!-- Articles Grid -->
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col" v-for="article in displayedArticles" :key="article.id">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <img :src="article.image" :alt="article.title"
                                    class="card-img-top img-fluid object-fit-cover" style="height: 250px" />
                                <div class="position-absolute top-0 start-0 bg-light p-2 rounded-bottom">
                                    <span class="small text-muted">{{ article.date }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ article.title }}</h5>
                                <p class="card-text text-muted small">
                                    {{ article.description }}
                                </p>
                                <!-- <a href="#" class="btn btn-link p-0">CONTINUE READING</a> -->
                                <router-link :to="{ name: 'blogPost', params: { id: article.id } }"
                                    class="btn btn-primary" @click="scrollToTop">CONTINUE READING</router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">Previous</a>
                        </li>
                        <li class="page-item" v-for="page in totalPages" :key="page"
                            :class="{ active: page === currentPage }">
                            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import { articles } from "../assets/blogs/blogs"; // <-- Import from new file

export default {
    name: "Articals",
    setup() {
        const articlesPerPage = 8;
        const currentPage = ref(1);

        const totalPages = computed(() =>
            Math.ceil(articles.length / articlesPerPage)
        );

        const displayedArticles = computed(() => {
            const startIndex = (currentPage.value - 1) * articlesPerPage;
            const endIndex = startIndex + articlesPerPage;
            return articles.slice(startIndex, endIndex);
        });

        const changePage = (page) => {
            if (page >= 1 && page <= totalPages.value) {
                currentPage.value = page;
            }
        };

        // Define a scrollToTop function
        const scrollToTop = () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        };

        return {
            articlesPerPage,
            currentPage,
            totalPages,
            displayedArticles,
            changePage,
            articles,
        };
    },
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        },
    }
};
</script>

<style scoped>
.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
}
</style>
