<template>
  <div class="container">
    <form
      @submit.prevent="handleSubmit"
      class="text-center border border-light p-5"
      novalidate
    >
      <p class="h4 mb-4">Sign in</p>
      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input
          type="email"
          id="form2Example1"
          class="form-control"
          v-model="email"
          :class="{ 'is-invalid': emailError }"
          required
        />
        <label class="form-label" for="form2Example1">Email address</label>
        <div v-if="emailError" class="invalid-feedback">{{ emailError }}</div>
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input
          type="password"
          id="form2Example2"
          class="form-control"
          v-model="password"
          :class="{ 'is-invalid': passwordError }"
          required
        />
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
            <input
              class="form-check-input"
              type="checkbox"
              v-model="remember"
              id="form2Example31"
            />
            <label class="form-check-label" for="form2Example31">
              Remember me
            </label>
          </div>
        </div>

        <div class="col">
          <!-- Simple link -->
          <a href="#!">Forgot password?</a>
        </div>
      </div>

      <!-- Submit button -->
      <button
        type="submit"
        data-mdb-button-init
        data-mdb-ripple-init
        class="btn btn-primary btn-block mb-4"
      >
        Sign in
      </button>

      <!-- Register buttons -->
      <div class="text-center">
        <p>Not a member? <router-link to="/register">Register</router-link></p>
        <p>or sign up with:</p>
        <button
          type="button"
          data-mdb-button-init
          data-mdb-ripple-init
          class="btn btn-link btn-floating mx-1"
        >
          <i class="fab fa-facebook-f"></i>
        </button>

        <button
          type="button"
          data-mdb-button-init
          data-mdb-ripple-init
          class="btn btn-link btn-floating mx-1"
        >
          <i class="fab fa-google"></i>
        </button>

        <button
          type="button"
          data-mdb-button-init
          data-mdb-ripple-init
          class="btn btn-link btn-floating mx-1"
        >
          <i class="fab fa-twitter"></i>
        </button>

        <button
          type="button"
          data-mdb-button-init
          data-mdb-ripple-init
          class="btn btn-link btn-floating mx-1"
        >
          <i class="fab fa-github"></i>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      remember: false,
      emailError: "",
      passwordError: "",
    };
  },
  methods: {
    validateEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    },
    handleSubmit() {
      this.emailError = "";
      this.passwordError = "";

      let valid = true;

      if (!this.email) {
        this.emailError = "Email is required.";
        valid = false;
      } else if (!this.validateEmail(this.email)) {
        this.emailError = "Please enter a valid email address.";
        valid = false;
      }

      if (!this.password) {
        this.passwordError = "Password is required.";
        valid = false;
      } else if (this.password.length < 6) {
        this.passwordError = "Password must be at least 6 characters.";
        valid = false;
      }

      if (valid) {
        // Submit form logic here (e.g., API call)
        // For now, just log the data
        // You can replace this with your actual login logic
        // console.log({
        //     email: this.email,
        //     password: this.password,
        //     remember: this.remember
        alert(
          "Login successful!" +
            JSON.stringify({
              email: this.email,
              password: this.password,
            })
        );
      }
    },
  },
};
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
