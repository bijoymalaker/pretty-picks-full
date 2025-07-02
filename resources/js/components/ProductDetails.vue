<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img :src="`./assets/images/${product.images[0]}`" class="d-block w-100"
                                alt="Product Image">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <h2>{{ product.name }}</h2>
                <p>৳{{ product.price }}</p>
                <button class="btn btn-primary">Add to Cart</button>
                <div v-html="product.description"></div>
            </div>
        </div>

        <div class="row mt-5">
            <h3>Related Products</h3>
            <div class="row">
                <div class="col-md-3" v-for="relatedProduct in product.relatedProducts" :key="relatedProduct.id">
                    <div class="card">
                        <img :src="`./assets/images/${relatedProduct.image}`" class="card-img-top"
                            alt="Related Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ relatedProduct.name }}</h5>
                            <p class="card-text">৳{{ relatedProduct.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductDetails',

    data() {
        return {
            product: {
                id: 1,
                name: 'AR Vitamin C B3 Gluta X10 Serum (10ml)',
                price: 500,
                description: '...', // Add product description here
                images: [
                    'image1.jpg',
                    'image2.jpg',
                    'image3.jpg',
                ],
                relatedProducts: [
                    { id: 2, name: 'Diamond Day Cream', price: 300, image: 'product2.jpg' },
                    { id: 3, name: 'Folic Anti-Bacterial Soap', price: 100, image: 'product3.jpg' },
                    // ... more related products
                ],
            },
        };
    },

};

</script>

<style scoped></style>