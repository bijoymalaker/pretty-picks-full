<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="text-center border border-light p-5" novalidate>
      <p class="h4 mb-4">Sign in</p>
      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form2Example1" class="form-control" v-model="email"
          :class="{ 'is-invalid': emailError }" required />
        <label class="form-label" for="form2Example1">Email address</label>
        <div v-if="emailError" class="invalid-feedback">{{ emailError }}</div>
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="form2Example2" class="form-control" v-model="password"
          :class="{ 'is-invalid': passwordError }" required />
        <label class="form-label" for="form2Example2">Password</label>
        <div v-if="passwordError" class="invalid-feedback">
          {{ passwordError }}
        </div>
      </div>

      <!-- 2 column grid layout for inline styling -->
      <div class="row mb-4">
        <div class="col d-flex justify-content-center">
          <!-- Checkbox -->
          <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="remember" id="form2Example31" />
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
      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
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
import { Link } from '@inertiajs/vue3'
import {route} from 'ziggy-js'
import AppLayouts from '../layout/AppLayouts.vue'
defineOptions({
  name: 'Login',
  layout: AppLayouts,
})

const email = ref("")
const password = ref("")
const remember = ref(false)
const emailError = ref("")
const passwordError = ref("")

function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  return re.test(email)
}

function handleSubmit() {
  emailError.value = ""
  passwordError.value = ""
  let valid = true
  if (!email.value) {
    emailError.value = "Email is required."
    valid = false
  } else if (!validateEmail(email.value)) {
    emailError.value = "Please enter a valid email address."
    valid = false
  }
  if (!password.value) {
    passwordError.value = "Password is required."
    valid = false
  } else if (password.value.length < 6) {
    passwordError.value = "Password must be at least 6 characters."
    valid = false
  }
  if (valid) {
    alert(
      "Login successful!" +
      JSON.stringify({
        email: email.value,
        password: password.value,
      })
    )
  }
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
