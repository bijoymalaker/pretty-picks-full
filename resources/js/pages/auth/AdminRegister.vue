<template>
  <section class="vh-100" style="background-color: #eee">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <p class="text-center h1 fw-bold mb-5 mx-1极 mx-md-4 mt-4">
                    Admin Sign up
                  </p>

                  <form class="mx-1 mx-md-4" @submit.prevent="onSubmit">
                    
                    <!-- Name -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input
                          type="text"
                          id="form3Example1c"
                          class="form-control"
                          v-model="form.name"
                          :class="{ 'is-invalid': form.errors.name }"
                        />
                        <label class="form-label" for="form3Example1c">Your Name</label>
                        <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                      </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input
                          type="email"
                          id="form3Example3c"
                          class="form-control"
                          v-model="form.email"
                          :class="{ 'is-invalid': form.errors.email }"
                        />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email }}</div>
                      </div>
                    </div>

                    <!-- Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input
                          type="password"
                          id="form3Example4c"
                          class="form-control"
                          v-model="form.password"
                          :class="{ 'is-invalid': form.errors.password }"
                        />
                        <label class="form-label" for="form3Example4c">Password</label>
                        <div class="invalid-feedback" v-if="form.errors.password">{{ form.errors.password }}</div>
                      </div>
                    </div>

                    <!-- Repeat Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input
                          type="password"
                          id="form3Example4cd"
                          class="form-control"
                          v-model="form.password_confirmation"
                          :class="{ 'is-invalid': form.errors.password_confirmation }"
                        />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                        <div class="invalid-feedback" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
                      </div>
                    </div>

                    <!-- Admin Key -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input
                          type="password"
                          id="adminKey"
                          class="form-control"
                          v-model="form.admin_key"
                          :class="{ 'is-invalid': form.errors.admin_key }"
                          placeholder="Enter admin secret key"
                        />
                        <label class="form-label" for="adminKey">Admin Key</label>
                        <div class="invalid-feedback" v-if="form.errors.admin_key">{{ form.errors.admin_key }}</div>
                      </div>
                    </div>

                    <!-- Terms -->
                    <div class="form-check d-flex justify-content-center mb-5">
                      <input
                        class="form-check-input me-2"
                        type="checkbox"
                        id="form2Example3c"
                        v-model="form.terms"
                        :class="{ 'is-invalid': form.errors.terms }"
                      />
                      <label class="form-check-label" for="form2Example3c">
                        I agree all statements in
                        <a href="#!">Terms of service</a>
                      </label>
                      <div class="invalid-feedback" v-if="form.errors.terms">{{ form.errors.terms }}</div>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg" :disabled="form.processing">
                        {{ form.processing ? 'Registering...' : 'Register as Admin' }}
                      </button>
                    </div>
                  </form>
                </div>

                <!-- Image -->
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid"
                    alt="Sample image"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AppLayouts from '../../layout/AppLayouts.vue'

defineOptions({
  name: "AdminRegister",
  layout: AppLayouts,
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  admin_key: '',
  terms: false,
})

function onSubmit() {
  form.post(route('admin.register.store'), {
    onError: (errors) => {
      console.log('Registration errors:', errors)
    },
    onSuccess: () => {
      // Redirect handled by controller
    }
  })
}
</script>

<style scoped>
.is-invalid {
  border-color: red !important;
}
</style>
