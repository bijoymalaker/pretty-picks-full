<template>
    <section class="banner-part" :style="{ backgroundImage: `url(${innerBanner})` }">
        <div class="text-section">
            <div class="text-center">
                <h2>Jonathon Kubb</h2>
                <h4>Photography</h4>
                <p>Based in New York since 2001</p>
            </div>
        </div>
    </section>

</template>
<script>
export default {
    name: "InnerPageBanner",
    components: {},
    props: {
        innerBanner: {
            type: String,
            default: "Inner Page Banner",
        },
    },
};
</script>
<style scoped>
.banner-part {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.banner-part {
    h2,h4,p{
        color: #fff;
        scale: 1.2;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
}
.text-section {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
}
</style>
