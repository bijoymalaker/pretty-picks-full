<template>
    <div>
        <section class="product-carousel py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4" v-for="(title, index) in titleMenu" :key="index">
                        <h2 class="text-center mb-4 fw-bold">{{ title.firstTitle }}</h2>
                        <h2 class="text-center mb-4 fw-light fn-space">{{ title.lastTitle }}</h2>
                        <p>{{ title.description }}</p>
                    </div>
                    <div class="col-md-8 text-end">
                        <Carousel :items-to-show="4" :autoplay="false" :gap="10" :breakpoints="{
                            0: { itemsToShow: 1 }, 768: { itemsToShow: 2 }, 992: { itemsToShow: 3 }, 1200: { itemsToShow: 4 },}">
                            <Slide v-for="(product, index) in products" :key="index">
                                <div class="card h-100">
                                    <img :src="product.image" class="card-img-top" :alt="product.name">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ product.name.substring(0,15)+".." }}</h5>
                                        <p class="card-text text-muted">{{ product.description.substring(0,8)+".." }}</p>
                                        <p class="fw-bold text-primary">৳ {{ product.price }}</p>
                                    </div>
                                </div>
                            </Slide>
                        </Carousel>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>
<script>
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
export default {
    name: 'Product',
    props: {
        products: {
            type: Array,
            required: true,
        },
        titleMenu: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            // products: [
            //     {
            //         name: "Korean H&S Arbutin Whitening Cream (15ml)",
            //         description: "Face Care, Whitening Cream",
            //         price: 1200,
            //         image: ""
            //     },
            //     {
            //         name: "Q-NBC Care Whitening Night Cream (15g)",
            //         description: "Face Care, Night Cream",
            //         price: 950,
            //         image: "product2.jpg"
            //     },
            //     {
            //         name: "C.S.E Rose Strawberry Face/Body Peeling Gel (300ml)",
            //         description: "Body Care, Peeling Gel",
            //         price: 850,
            //         image: ""
            //     },
            //     {
            //         name: "Madam White Tomato Gluta Soap",
            //         description: "Skin Care, Soap",
            //         price: 750,
            //         image: ""
            //     },
            //     {
            //         name: "Madam White Tomato Gluta Soap",
            //         description: "Skin Care, Soap",
            //         price: 750,
            //         image: ""
            //     },
            //     {
            //         name: "Madam White Tomato Gluta Soap",
            //         description: "Skin Care, Soap",
            //         price: 750,
            //         image: ""
            //     },
            // ],

        }
    },
    components: {
        Carousel,
        Slide

    }
}
</script>
<style scoped>
.product-carousel .card {
    border: none;
    transition: transform 0.3s;
}

.product-carousel .card:hover {
    transform: scale(1.05);
}
.fn-space {
    letter-spacing: 0.5rem;
}
</style>