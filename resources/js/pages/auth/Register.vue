<template>
  <section class="vh-100" style="background-color: #eee">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form class="mx-1 mx-md-4" @submit.prevent="onSubmit">

                    <!-- Name -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" class="form-control" v-model="form.name"
                          :class="{ 'is-invalid': errors.name }" />
                        <label class="form-label" for="form3Example1c">Your Name</label>
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name }}</div>
                      </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="form3Example3c" class="form-control" v-model="form.email" :class="{ 'is-invalid': errors.email }" />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <div class="invalid-feedback" v-if="errors.email">{{ errors.email }}</div>
                      </div>
                    </div>

                    <!-- Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" class="form-control" v-model="form.password" :class="{ 'is-invalid': errors.password }" />
                        <label class="form-label" for="form3Example4c">Password</label>
                        <div class="invalid-feedback" v-if="errors.password">{{ errors.password }}</div>
                      </div>
                    </div>

                    <!-- Repeat Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4cd" class="form-control" v-model="form.repeatPassword" :class="{ 'is-invalid': errors.repeatPassword }" />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                        <div class="invalid-feedback" v-if="errors.repeatPassword">{{ errors.repeatPassword }}</div>
                      </div>
                    </div>

                    <!-- Terms -->
                    <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" id="form2Example3c" v-model="form.terms" :class="{ 'is-invalid': errors.terms }" />
                      <label class="form-check-label" for="form2Example3c">
                        I agree all statements in
                        <a href="#!">Terms of service</a>
                      </label>
                      <div class="invalid-feedback" v-if="errors.terms">{{ errors.terms }}</div>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Register </button>
                    </div>
                  </form>
                </div>

                <!-- Image -->
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive } from 'vue';
import AppLayouts from '@/layout/AppLayouts.vue';

defineOptions({
  name: "Register",
  layout: AppLayouts,
});

const form = reactive({
  name: "",
  email: "",
  password: "",
  repeatPassword: "",
  terms: false,
});

const errors = reactive({
  name: "",
  email: "",
  password: "",
  repeatPassword: "",
  terms: "",
});

function validate() {
  let valid = true;
  errors.name = "";
  errors.email = "";
  errors.password = "";
  errors.repeatPassword = "";
  errors.terms = "";

  if (!form.name) {
    errors.name = "Name is required.";
    valid = false;
  }
  if (!form.email) {
    errors.email = "Email is required.";
    valid = false;
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
    errors.email = "Email is invalid.";
    valid = false;
  }
  if (!form.password) {
    errors.password = "Password is required.";
    valid = false;
  } else if (form.password.length < 6) {
    errors.password = "Password must be at least 6 characters.";
    valid = false;
  }
  if (!form.repeatPassword) {
    errors.repeatPassword = "Please repeat your password.";
    valid = false;
  } else if (form.password !== form.repeatPassword) {
    errors.repeatPassword = "Passwords do not match.";
    valid = false;
  }
  if (!form.terms) {
    errors.terms = "You must agree to the terms.";
    valid = false;
  }

  return valid;
}

function onSubmit() {
  if (validate()) {
    alert("Registration successful!");
    form.name = "";
    form.email = "";
    form.password = "";
    form.repeatPassword = "";
    form.terms = false;
  }
}
</script>

<style scoped>
.is-invalid {
  border-color: red !important;
}
</style>
