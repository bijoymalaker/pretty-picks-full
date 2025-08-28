import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export const useWishlistStore = defineStore('wishlist', () => {
    const page = usePage()
const user = computed(() => {
    return page.props.value && page.props.value.auth ? page.props.value.auth.user : null;
})

    const wishlist = ref([])
    
    const wishlistItemsCount = computed(() => wishlist.value.length)
    
    function addToWishlist(product) {
        if (!user.value) {
            alert('Please login to add items to the wishlist.')
            return
        }
        const existingItem = wishlist.value.find(item => item.id === product.id)
        if (!existingItem) {
            wishlist.value.push(product)
        }
    }
    
    function removeFromWishlist(productId) {
        if (!user.value) {
            alert('Please login to remove items from the wishlist.')
            return
        }
        const index = wishlist.value.findIndex(item => item.id === productId)
        if (index > -1) {
            wishlist.value.splice(index, 1)
        }
    }
    
    function isInWishlist(productId) {
        return wishlist.value.some(item => item.id === productId)
    }
    
    function clearWishlist() {
        if (!user.value) {
            alert('Please login to clear the wishlist.')
            return
        }
        wishlist.value = []
    }
    
    return {
        wishlist,
        wishlistItemsCount,
        addToWishlist,
        removeFromWishlist,
        isInWishlist,
        clearWishlist
    }
})
