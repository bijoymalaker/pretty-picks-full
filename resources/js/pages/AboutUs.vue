<template>
  <AppLayouts>
    <div class="about-us-page">
      <!-- Hero Section -->
      <section class="hero-section">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
              <div class="hero-content">
                <span class="subtitle">About Pretty Picks</span>
                <h1>Curating Beauty and Style Since 2025</h1>
                <p>
                  At Pretty Picks, we believe that everyone deserves to feel beautiful and confident. Our carefully
                  curated
                  collection of fashion, beauty, and lifestyle products brings you the latest trends and timeless
                  classics, all in
                  one place.
                </p>
                <div class="hero-stats">
                  <div class="stat">
                    <h3>50K+</h3>
                    <p>Happy Customers</p>
                  </div>
                  <div class="stat">
                    <h3>1000+</h3>
                    <p>Premium Products</p>
                  </div>
                  <div class="stat">
                    <h3>4.9/5</h3>
                    <p>Customer Rating</p>
                  </div>
                </div>
                <Link :href="route('shop')" class="btn btn-danger">Shop Now</Link>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="hero-image">
                <img src="https://i.ibb.co/0jZ8Z8Z/pretty-picks-hero.jpg" alt="Pretty Picks Fashion Collection"
                  class="img-fluid" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our Story Section -->
      <section class="story-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="story-image">
                <img src="https://i.ibb.co/4p8Z8Z8/pretty-picks-story.jpg" alt="Our Story" class="img-fluid" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="story-content">
                <h2>Our Story</h2>
                <p>
                  Founded in 2020, Pretty Picks was born from a passion for fashion and beauty. Our founder, a style
                  enthusiast with
                  years of experience in the industry, saw the need for a curated online destination that offers quality
                  products at
                  affordable prices.
                </p>
                <p>
                  Today, we proudly serve fashion lovers across the globe, offering a carefully selected range of
                  clothing,
                  accessories, beauty products, and lifestyle items. Our commitment to quality, style, and customer
                  satisfaction has
                  made us a trusted name in online shopping.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our Values Section -->
      <section class="values-section">
        <div class="container">
          <div class="section-title">
            <h2>Our Values</h2>
            <p>What drives us every day</p>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="value-card">
                <div class="value-icon">
                  <i class="fas fa-heart"></i>
                </div>
                <h3>Passion for Style</h3>
                <p>We are passionate about fashion and beauty, curating products that make you feel amazing.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="value-card">
                <div class="value-icon">
                  <i class="fas fa-users"></i>
                </div>
                <h3>Customer First</h3>
                <p>Your satisfaction and happiness are at the heart of everything we do.</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="value-card">
                <div class="value-icon">
                  <i class="fas fa-leaf"></i>
                </div>
                <h3>Sustainability</h3>
                <p>We are committed to eco-friendly practices and ethical sourcing.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our Team Section -->
      <section class="team-section">
        <div class="container">
          <div class="section-title">
            <h2>Meet Our Team</h2>
            <p>The style experts behind Pretty Picks</p>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6" v-for="(team, index) in fullTeam" :key="index">
              <div class="team-member">
                <img :src="team.image" :alt="team.name" class="img-fluid" />
                <h4>{{ team.name }}</h4>
                <p>{{ team.designation }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Why Choose Us Section -->
      <section class="why-choose-section">
        <div class="container">
          <div class="section-title">
            <h2>Why Choose Pretty Picks?</h2>
            <p>Discover what sets us apart</p>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="feature-list">
                <div class="feature-item">
                  <i class="fas fa-star"></i>
                  <div>
                    <h4>Curated Selection</h4>
                    <p>Handpicked fashion and beauty products from top brands</p>
                  </div>
                </div>
                <div class="feature-item">
                  <i class="fas fa-truck"></i>
                  <div>
                    <h4>Free Shipping</h4>
                    <p>Free delivery on orders over ৳50</p>
                  </div>
                </div>
                <div class="feature-item">
                  <i class="fas fa-mobile-alt"></i>
                  <div>
                    <h4>Mobile Shopping</h4>
                    <p>Shop on-the-go with our mobile-optimized app</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="feature-list">
                <div class="feature-item">
                  <i class="fas fa-undo"></i>
                  <div>
                    <h4>Easy Returns</h4>
                    <p>30-day return policy for your peace of mind</p>
                  </div>
                </div>
                <div class="feature-item">
                  <i class="fas fa-headset"></i>
                  <div>
                    <h4>Style Advice</h4>
                    <p>Personal styling tips from our fashion experts</p>
                  </div>
                </div>
                <div class="feature-item">
                  <i class="fas fa-gift"></i>
                  <div>
                    <h4>Loyalty Rewards</h4>
                    <p>Earn points on every purchase for exclusive discounts</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
       <ContactForm />
      
    </div>
  </AppLayouts>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayouts from '../layout/AppLayouts.vue';
import { route } from 'ziggy-js';
import ContactForm from '../components/ContactForm.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';

const fullTeam = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('/assets/fullTeam.json');
    fullTeam.value = response.data;
  } catch (error) {
    console.error('Failed to load fullTeam.json:', error);
  }
});



</script>
<style scoped>
/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 100px 0;
  position: relative;
  overflow: hidden;
}

/* .hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="60" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
  opacity: 0.3;
} */

.hero-content .subtitle {
  display: block;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 20px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.hero-content h1 {
  font-size: 48px;
  font-weight: 700;
  margin-bottom: 30px;
  line-height: 1.2;
}

.hero-content p {
  font-size: 18px;
  line-height: 1.6;
  margin-bottom: 40px;
  opacity: 0.9;
}

.hero-stats {
  display: flex;
  gap: 40px;
  margin-bottom: 40px;
}

.hero-stats .stat h3 {
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 5px;
}

.hero-stats .stat p {
  font-size: 14px;
  opacity: 0.8;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.hero-image img {
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Story Section */
.story-section {
  padding: 100px 0;
  background: #f8f9fa;
}

.story-content h2 {
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 30px;
  color: #2c3e50;
}

.story-content p {
  font-size: 18px;
  line-height: 1.6;
  margin-bottom: 20px;
  color: #5a6c7d;
}

.story-image img {
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Values Section */
.values-section {
  padding: 100px 0;
  background: white;
}

.section-title {
  text-align: center;
  margin-bottom: 60px;
}

.section-title h2 {
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 15px;
  color: #2c3e50;
}

.section-title p {
  font-size: 18px;
  color: #5a6c7d;
}

.value-card {
  background: #f8f9fa;
  padding: 40px 30px;
  border-radius: 20px;
  text-align: center;
  margin-bottom: 30px;
  transition: all 0.3s ease;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.value-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.value-icon {
  font-size: 48px;
  color: #667eea;
  margin-bottom: 20px;
}

.value-card h3 {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #2c3e50;
}

.value-card p {
  font-size: 16px;
  color: #5a6c7d;
  line-height: 1.5;
}

/* Team Section */
.team-section {
  padding: 100px 0;
  background: #f8f9fa;
}

.team-member {
  background: white;
  padding: 30px;
  border-radius: 20px;
  text-align: center;
  margin-bottom: 30px;
  transition: all 0.3s ease;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.team-member:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.team-member img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  margin-bottom: 20px;
  object-fit: cover;
}

.team-member h4 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 5px;
  color: #2c3e50;
}

.team-member p {
  font-size: 14px;
  color: #667eea;
  font-weight: 500;
}

/* Why Choose Us Section */
.why-choose-section {
  padding: 100px 0;
  background: white;
}

.feature-list {
  padding: 0 20px;
}

.feature-item {
  display: flex;
  align-items: center;
  margin-bottom: 30px;
}

.feature-item i {
  font-size: 24px;
  color: #667eea;
  margin-right: 20px;
  width: 40px;
  text-align: center;
}

.feature-item h4 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 5px;
  color: #2c3e50;
}

.feature-item p {
  font-size: 16px;
  color: #5a6c7d;
  margin: 0;
}



/* Responsive Design */
@media (max-width: 768px) {
  .hero-content h1 {
    font-size: 32px;
  }

  .hero-stats {
    flex-direction: column;
    gap: 20px;
  }

  .story-section .row {
    flex-direction: column-reverse;
  }

  .feature-item {
    flex-direction: column;
    text-align: center;
  }

  .feature-item i {
    margin-right: 0;
    margin-bottom: 10px;
  }
}
</style>
