<template>
    <section class="makeup-essentials py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <img :src="blog1" alt="Discover Makeup Essentials" class="img-fluid rounded">
          </div>
          <div class="col-md-6">
            <h2 class="text-muted">Discover a beautiful you</h2>
            <h1 class="fw-bold">with our new <span class="text-primary">Makeup Essentials</span></h1>
            <p class="text-muted">
              It is a long-established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.
            </p>
            <div class="row mb-3">
              <div class="col-md-6">
                <p class="text-primary fw-bold"><i class="bi bi-check-circle"></i> Lasting Formulas</p>
                <p class="text-primary fw-bold"><i class="bi bi-check-circle"></i> Face Skin Protection</p>
              </div>
              <div class="col-md-6">
                <p class="text-primary fw-bold"><i class="bi bi-check-circle"></i> Eye Care Products</p>
              </div>
            </div>
            <button class="btn btn-primary me-2">SHOP NOW</button>
            <button class="btn btn-outline-primary">READ MORE</button>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>

  import blog1 from "../assets/images/blog1.jpg";



  export default {
    name: "MakeupEssentials",
    data() {
      return {
        blog1,
      };
    },
  };
  </script>
  
  <style scoped>
  .makeup-essentials {
    background-color: #f8f9fa;
  }
  </style>
  