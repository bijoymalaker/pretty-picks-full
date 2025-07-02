<template>
    <div>
        <section class="sections-carousel py-5">
            <div class="container">
                <Carousel :items-to-show="3" :autoplay="false" :loop="true" :gap="15"
                    :breakpoints="{0: {itemsToShow: 1}, 640: { itemsToShow: 1 }, 768: { itemsToShow: 2 }, 1024: { itemsToShow: 3 } }">
                    <Slide v-for="(section, index) in sections" :key="index">
                        <div class="card">
                            <img :src="section.image" class="card-img-top" :alt="section.name">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ section.name }}</h5>
                                <p class="card-text text-muted">{{ section.description }}</p>
                                <button class="btn btn-outline-primary">READ MORE</button>
                            </div>
                        </div>
                    </Slide>
                </Carousel>
            </div>
        </section>

    </div>
</template>
<script>

import shorts1 from '../assets/images/products/shorts1.jpg';
import sports2 from '../assets/images/products/sports2.jpg';
import watch4 from '../assets/images/products/watch4.jpg';


import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
export default {
    name: 'Sections',
    data() {
        return {

            sections: [
                { name: "Serums & Oils", description: "Hydrating and nourishing products.", image: shorts1 },
                { name: "Organics Cream", description: "Natural and organic creams.", image: sports2 },
                { name: "Facial Cleanser", description: "Gentle and effective face cleansers.", image: watch4 }
            ]
        };

    },
    components: {
        Carousel,
        Slide

    }
}
</script>
<style scoped></style>