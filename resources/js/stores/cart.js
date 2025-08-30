import { defineStore } from 'pinia'
import { ref, computed, watch } from 'vue'

export const useCartStore = defineStore('cart', () => {
    // Load cart from localStorage if available
    const loadCartFromStorage = () => {
        try {
            const savedCart = localStorage.getItem('cart')
            return savedCart ? JSON.parse(savedCart) : []
        } catch (error) {
            console.error('Error loading cart from localStorage:', error)
            return []
        }
    }

    const cart = ref(loadCartFromStorage())
    
    const cartTotal = computed(() => {
        return cart.value.reduce((total, item) => total + (item.price * item.qty), 0)
    })
    
    const cartItemsCount = computed(() => {
        return cart.value.reduce((count, item) => count + item.qty, 0)
    })
    
    // Save cart to localStorage whenever it changes
    watch(cart, (newCart) => {
        try {
            localStorage.setItem('cart', JSON.stringify(newCart))
        } catch (error) {
            console.error('Error saving cart to localStorage:', error)
        }
    }, { deep: true })
    
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
