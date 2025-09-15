<template>
    <div>
        
        <div class="container my-5">
            <div v-if="loading" class="text-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            
            <div v-else-if="product" class="row">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="product-image-container">
                        <img :src="getProductImage(product)" :alt="product.name" class="img-fluid rounded" />
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('shop')">Shop</Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ product.name }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="product-title">{{ product.name }}</h1>
                    
                    <div class="product-meta mb-3">
                        <span class="badge bg-secondary me-2">{{ product.collection || 'Uncategorized' }}</span>
                        <span class="text-muted">SKU: #{{ product.id }}</span>
                    </div>
                    
                    <div class="product-price mb-4">
                        <h3 class="text-primary">৳{{ formatPrice(product.price) }}</h3>
                    </div>
                    
                    <div class="product-description mb-4">
                        <h5>Description</h5>
                        <p>{{ product.description || 'No description available.' }}</p>
                    </div>
                    
                    <div class="product-actions">
                        <div class="d-flex gap-3">
                            <button @click="addToCart" class="btn btn-primary btn-lg">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                            <button @click="addToWishlist" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-heart"></i> Add to Wishlist
                            </button>
                        </div>
                    </div>
                    
                    <div class="product-info mt-4">
                        <div class="accordion" id="productAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details">
                                        Product Details
                                    </button>
                                </h2>
                                <div id="details" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><strong>Collection:</strong> {{ product.collection || 'N/A' }}</li>
                                            <li><strong>Price:</strong> ৳{{ formatPrice(product.price) }}</li>
                                            <li><strong>Availability:</strong> In Stock</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div v-else class="text-center">
                <h2>Product Not Found</h2>
                <p>The product you're looking for doesn't exist.</p>
                <Link :href="route('shop')" class="btn btn-primary">Back to Shop</Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import AppLayout from '@/layout/AppLayouts.vue';
defineOptions({
    name: 'ProductPage',
    layout: AppLayout,
})

import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { useCartStore } from '@/stores/cart';
import { useWishlistStore } from '@/stores/wishlist';

const props = defineProps({
        id: [String, Number]
});

const product = ref(null);
const loading = ref(true);

// Initialize stores
const cartStore = useCartStore();
const wishlistStore = useWishlistStore();

onMounted(async () => {
        await fetchProduct();
});

const fetchProduct = async () => {
        try {
                const response = await fetch(`/api/products/${props.id}`);
                if (response.ok) {
                        product.value = await response.json();
                } else {
                        product.value = null;
                }
        } catch (error) {
                console.error('Error fetching product:', error);
                product.value = null;
        } finally {
                loading.value = false;
        }
};

const getProductImage = (product) => {
        if (product.image) {
                return `/storage/${product.image}`;
        }
        return 'https://via.placeholder.com/600x600?text=No+Image';
};

const formatPrice = (price) => {
        const numPrice = typeof price === 'string' ? parseFloat(price) : price;
        return numPrice.toFixed(2);
};

const addToCart = () => {
        if (product.value) {
                cartStore.addToCart(product.value);
                showNotification('Product added to cart!', 'success');
        }
};

const addToWishlist = () => {
        if (product.value) {
                wishlistStore.addToWishlist(product.value);
                showNotification('Product added to wishlist!', 'success');
        }
};

const showNotification = (message) => {
        alert(message);
};
</script>

<style scoped>
.product-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
}

.product-image-container img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}

.product-image-container:hover img {
    transform: scale(1.05);
}

.product-meta {
    font-size: 0.9rem;
}

.product-price h3 {
    font-size: 2rem;
    font-weight: 700;
}

.product-actions .btn {
    padding: 0.75rem 2rem;
    font-weight: 600;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #212529;
}

@media (max-width: 768px) {
    .product-title {
        font-size: 2rem;
    }
    
    .product-actions {
        flex-direction: column;
    }
    
    .product-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
