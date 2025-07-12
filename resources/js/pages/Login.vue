<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="text-center border border-light p-5" novalidate>
      <p class="h4 mb-4">Sign in</p>
      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form2Example1" class="form-control" v-model="form.email"
          :class="{ 'is-invalid': errors.email }" required />
        <label class="form-label" for="form2Example1">Email address</label>
        <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="form2Example2" class="form-control" v-model="form.password"
          :class="{ 'is-invalid': errors.password }" required />
        <label class="form-label" for="form2Example2">Password</label>
        <div v-if="errors.password" class="invalid-feedback">
          {{ errors.password }}
        </div>
      </div>

      <!-- 2 column grid layout for inline styling -->
      <div class="row mb-4">
        <div class="col d-flex justify-content-center">
          <!-- Checkbox -->
          <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="form.remember" id="form2Example31" />
            <label class="form-check-label" for="form2Example31">
              Remember me
            </label>
          </div>
        </div>

        <div class="col">
          <!-- Simple link -->
          <a href="#">Forgot password?</a>
        </div>
      </div>

      <!-- Submit button -->
      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" :disabled="processing">
        Sign in
      </button>

      <!-- Register buttons -->
      <div class="text-center">
        <p>Not a member? <Link :href="route('register')">Register</Link></p>
        <p>or sign up with:</p>
        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
          <i class="fab fa-facebook-f"></i>
        </button>

        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
          <i class="fab fa-google"></i>
        </button>

        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
          <i class="fab fa-twitter"></i>
        </button>

        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
          <i class="fab fa-github"></i>
        </button>
      </div>
    </form>
  </div>
</template>
<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import route from 'ziggy-js'
import AppLayouts from '../layout/AppLayouts.vue'
defineOptions({
  name: 'Login',
  layout: AppLayouts,
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const processing = ref(false)
const errors = ref({})

function handleSubmit() {
  processing.value = true
  form.post(route('login'), {
    onError: (err) => {
      errors.value = err
      processing.value = false
    },
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
<style>
.is-invalid {
  border-color: #dc3545;
}

.invalid-feedback {
  color: #dc3545;
  font-size: 0.875em;
}
</style>
