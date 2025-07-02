<template>
    <section class="category-carousel py-5">
        <div class="container">
            <Carousel :items-to-show="4" :autoplay="false" :gap="10" :breakpoints="{
                0: { itemsToShow: 1 },
                768: { itemsToShow: 2 },
                992: { itemsToShow: 3 },
                1200: { itemsToShow: 4 },
            }">
                <Slide v-for="(category, index) in categories" :key="index">
                    <div class="card h-100">
                        <img :src="category.image" class="card-img-top" :alt="category.name" />
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ category.name }}</h5>
                        </div>
                    </div>
                </Slide>
            </Carousel>
        </div>
    </section>
</template>
<script>
// Category Images import
import shoeCategory from "../assets/images/products/shoeCategory.jpg";
import tshirtCategory from "../assets/images/products/tshirtCategory.jpg";
import hatCategory from "../assets/images/products/hatCategory.jpg";
import huddiCategory from "../assets/images/products/huddiCategory.jpg";
import perfume from "../assets/images/products/perfume.jpg";
import shampoo from "../assets/images/products/shampoo.jpg";
import watch1 from "../assets/images/products/watch1.jpg";

import { Carousel, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";
export default {
    name: "Product",
    data() {
        return {
            categories: [
                {
                    name: "Shoe",
                    image: shoeCategory,
                },
                {
                    name: "T-Shirt",
                    image: tshirtCategory,
                },
                {
                    name: "Hat",
                    image: hatCategory,
                },
                {
                    name: "Huddi",
                    image: huddiCategory,
                },
                {
                    name: "Perfume",
                    image: perfume,
                },
                {
                    name: "Shampoo",
                    image: shampoo,
                },
                {
                    name: "Watch",
                    image: watch1,
                },
            ],
        };
    },
    components: {
        Carousel,
        Slide,
    },
};
</script>
<style scoped>
.category-carousel .card {
    border: none;
    transition: transform 0.3s;
}

.category-carousel .card:hover {
    transform: scale(1.05);
}
</style>
