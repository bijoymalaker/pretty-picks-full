<template>
  <AppLayouts>
    <div>
        <h1 class="text-center my-4">Contact Us</h1>
        <form @submit.prevent="submitForm" class="container p-4 border rounded shadow-sm bg-light">
            <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" v-model="form.name" class="form-control" required />
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" v-model="form.email" class="form-control" required />
            </div>
            <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea id="message" v-model="form.message" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>

    </div>
  </AppLayouts>
</template>
import AppLayouts from '../layout/AppLayouts.vue';
<script>
export default {
    name: 'ContactUs',
    data() {
        return {
            form: {
                name: '',
                email: '',
                message: ''
            }

        }


    },
    components: {
        AppLayouts
    }
}
</script>
<style scoped>


</style>