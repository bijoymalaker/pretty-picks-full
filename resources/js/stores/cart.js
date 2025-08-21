import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useCartStore = defineStore('cart', () => {
    const cart = ref([])
    
    const cartTotal = computed(() => {
        return cart.value.reduce((total, item) => total + (item.price * item.qty), 0)
    })
    
    const cartItemsCount = computed(() => {
        return cart.value.reduce((count, item) => count + item.qty, 0)
    })
    
    function addToCart(product, quantity = 1) {
        const existingItem = cart.value.find(item => item.id === product.id)
        if (existingItem) {
            existingItem.qty += quantity
        } else {
            cart.value.push({
                ...product,
                qty: quantity
            })
        }
    }
    
    function removeFromCart(productId) {
        const index = cart.value.findIndex(item => item.id === productId)
        if (index > -1) {
            cart.value.splice(index, 1)
        }
    }
    
    function updateQuantity(productId, quantity) {
        const item = cart.value.find(item => item.id === productId)
        if (item) {
            item.qty = quantity
            if (item.qty <= 0) {
                removeFromCart(productId)
            }
        }
    }
    
    function clearCart() {
        cart.value = []
    }
    
    return {
        cart,
        cartTotal,
        cartItemsCount,
        addToCart,
        removeFromCart,
        updateQuantity,
        clearCart
    }
})
