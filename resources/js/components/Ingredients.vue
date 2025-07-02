<template>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="text-center">
            <h2 class="display-6 fw-bold mb-3">ORGANIC INGREDIENTS</h2>
            <p class="mb-5 text-muted">Majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
          </div>
  
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col" v-for="(item, index) in ingredients" :key="index">
              <div class="card h-100 border-0 shadow-sm">
                <img :src="item.image" :alt="item.title" class="card-img-top img-fluid object-fit-cover" style="height: 250px;">
                <div class="card-body text-center">
                  <h3 class="card-title mt-2">{{ index + 1 }}. {{ item.title }}</h3>
                  <p class="card-text text-muted small">The generated Lorem Ipsum is therefore always free from repetition, humour.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import clothes1 from '../assets/images/products/clothes1.jpg'; // Import your images
  import clothes2 from '../assets/images/products/clothes2.jpg';
  import clothes3 from '../assets/images/products/clothes3.jpg';
  
  const ingredients = [
    { title: 'SALTS & SUGARS', image: clothes1 },
    { title: 'NATURAL TINCTURES', image: clothes2 },
    { title: 'ESSENTIAL OILS', image: clothes3 },
  ];
  </script>
  
  <style scoped>
  /* Optional custom styles */
  .display-6 {
      font-size: 2.5rem; /* Adjust as needed */
  }
  </style>