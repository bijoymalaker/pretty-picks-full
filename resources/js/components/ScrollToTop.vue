<template>
    <button v-show="isVisible" @click="scrollToTop" class="scroll-to-top">
        <font-awesome-icon icon="fa-solid fa-arrow-turn-up" />
    </button>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';

export default {
    name: 'ScrollToTop',
    setup() {
        const isVisible = ref(false);

        const toggleVisibility = () => {
            isVisible.value = window.scrollY > 200; // Show button after scrolling 200px
        };

        const scrollToTop = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        };

        onMounted(() => {
            window.addEventListener('scroll', toggleVisibility);
        });

        onUnmounted(() => {
            window.removeEventListener('scroll', toggleVisibility);
        });

        return { isVisible, scrollToTop };
    },
};
</script>

<style scoped>
.scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #FCD0B0;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    font-size: 21px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: linear 0.5s ease-in-out;
}

.scroll-to-top:hover {
    background-color: #616b77;
}
</style>