<template>
  <AppLayouts>
    <section class="vh-100" style="background-color: #eee">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                      Sign up
                    </p>

                    <form class="mx-1 mx-md-4" @submit.prevent="onSubmit">
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div
                          data-mdb-input-init
                          class="form-outline flex-fill mb-0"
                        >
                          <input
                            type="text"
                            id="form3Example1c"
                            class="form-control"
                            v-model="form.name"
                            :class="{ 'is-invalid': errors.name }"
                            required
                          />
                          <label class="form-label" for="form3Example1c"
                            >Your Name</label
                          >
                          <div class="invalid-feedback" v-if="errors.name">
                            {{ errors.name }}
                          </div>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div
<script>
import AppLayouts from '../layout/AppLayouts.vue';
export default {
  components: { AppLayouts }
}
</script>
                          data-mdb-input-init
                          class="form-outline flex-fill mb-0"
                        >
                          <input
                            type="email"
                            id="form3Example3c"
                            class="form-control"
                            v-model="form.email"
                            :class="{ 'is-invalid': errors.email }"
                            required
                          />
                          <label class="form-label" for="form3Example3c"
                            >Your Email</label
                          >
                          <div class="invalid-feedback" v-if="errors.email">
                            {{ errors.email }}
                          </div>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div
                          data-mdb-input-init
                          class="form-outline flex-fill mb-0"
                        >
                          <input
                            type="password"
                            id="form3Example4c"
                            class="form-control"
                            v-model="form.password"
                            :class="{ 'is-invalid': errors.password }"
                            required
                          />
                          <label class="form-label" for="form3Example4c"
                            >Password</label
                          >
                          <div class="invalid-feedback" v-if="errors.password">
                            {{ errors.password }}
                          </div>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div
                          data-mdb-input-init
                          class="form-outline flex-fill mb-0"
                        >
                          <input
                            type="password"
                            id="form3Example4cd"
                            class="form-control"
                            v-model="form.repeatPassword"
                            :class="{ 'is-invalid': errors.repeatPassword }"
                            required
                          />
                          <label class="form-label" for="form3Example4cd"
                            >Repeat your password</label
                          >
                          <div
                            class="invalid-feedback"
                            v-if="errors.repeatPassword"
                          >
                            {{ errors.repeatPassword }}
                          </div>
                        </div>
                      </div>

                      <div
                        class="form-check d-flex justify-content-center mb-5"
                      >
                        <input
                          class="form-check-input me-2"
                          type="checkbox"
                          id="form2Example3c"
                          v-model="form.terms"
                          :class="{ 'is-invalid': errors.terms }"
                          required
                        />
                        <label class="form-check-label" for="form2Example3c">
                          I agree all statements in
                          <a href="#!">Terms of service</a>
                        </label>
                        <div class="invalid-feedback" v-if="errors.terms">
                          {{ errors.terms }}
                        </div>
                      </div>

                      <div
                        class="d-flex justify-content-center mx-4 mb-3 mb-lg-4"
                      >
                        <button
                          type="submit"
                          data-mdb-button-init
                          data-mdb-ripple-init
                          class="btn btn-primary btn-lg"
                        >
                          Register
                        </button>
                      </div>
                    </form>
                  </div>
                  <div
                    class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2"
                  >
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
<script>
export default {
  name: "Register",
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        repeatPassword: "",
        terms: false,
      },
      errors: {},
    };
  },
  methods: {
    validate() {
      const errors = {};
      if (!this.form.name) {
        errors.name = "Name is required.";
      }
      if (!this.form.email) {
        errors.email = "Email is required.";
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
        errors.email = "Email is invalid.";
      }
      if (!this.form.password) {
        errors.password = "Password is required.";
      } else if (this.form.password.length < 6) {
        errors.password = "Password must be at least 6 characters.";
      }
      if (!this.form.repeatPassword) {
        errors.repeatPassword = "Please repeat your password.";
      } else if (this.form.password !== this.form.repeatPassword) {
        errors.repeatPassword = "Passwords do not match.";
      }
      if (!this.form.terms) {
        errors.terms = "You must agree to the terms.";
      }
      this.errors = errors;
      return Object.keys(errors).length === 0;
    },
    onSubmit() {
      if (this.validate()) {
        // Submit form logic here
        alert("Registration successful!");
        // Reset form if needed
        this.form = {
          name: "",
          email: "",
          password: "",
          repeatPassword: "",
          terms: false,
        };
        this.errors = {};
      }
    },
  },
};
</script>
<style></style>
