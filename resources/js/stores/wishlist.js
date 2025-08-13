import { ref, computed } from 'vue'

export function useWishlistStore() {
    const wishlist = ref([])
    
    const wishlistItemsCount = computed(() => wishlist.value.length)
    
    function addToWishlist(product) {
        const existingItem = wishlist.value.find(item => item.id === product.id)
        if (!existingItem) {
            wishlist.value.push(product)
        }
    }
    
    function removeFromWishlist(productId) {
        const index = wishlist.value.findIndex(item => item.id === productId)
        if (index > -1) {
            wishlist.value.splice(index, 1)
        }
    }
    
    function isInWishlist(productId) {
        return wishlist.value.some(item => item.id === productId)
    }
    
    function clearWishlist() {
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
}
