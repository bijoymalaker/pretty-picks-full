<template>
    <section class="contact-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="contact-content">
                <h2>Get In Touch</h2>
                <p>Have questions about our products or need styling advice? We're here to help!</p>
                <div class="contact-info">
                  <div class="contact-item">
                   <font-awesome-icon icon="fa-regular fa-envelope" class="me-3" />
                    <span>hello@prettypicks.com</span>
                  </div>
                  <div class="contact-item">
                    <font-awesome-icon icon="fa-solid fa-phone" class="me-3" />
                    <span>+1 (555) 987-6543</span>
                  </div>
                  <div class="contact-item">
                    <font-awesome-icon icon="fa-solid fa-location-dot" class="me-3"  />
                    <span>456 Fashion Avenue, Style City, SC 67890</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="contact-form">
                <form action="#" method="post">
                  <div class="form-group">
                    <input type="text" placeholder="Your Name" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="email" placeholder="Your Email" class="form-control" />
                  </div>
                  <div class="form-group">
                    <textarea placeholder="Your Message" class="form-control" rows="5"></textarea>
                  </div>
                  <button type="submit" class="btn btn-danger">Send Message</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
</template>
<script setup>



</script>
<style scoped>

/* Contact Section */
.contact-section {
  padding: 100px 0;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
}

.contact-content h2 {
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 20px;
}

.contact-content p {
  font-size: 18px;
  margin-bottom: 40px;
  opacity: 0.9;
}

.contact-info {
  margin-bottom: 40px;
}

.contact-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.contact-item i {
  font-size: 20px;
  margin-right: 15px;
  width: 30px;
}

.contact-item span {
  font-size: 16px;
}

.contact-form .form-group {
  margin-bottom: 20px;
}

.contact-form .form-control {
  width: 100%;
  padding: 15px;
  border: none;
  border-radius: 10px;
  font-size: 16px;
  background: rgba(255, 255, 255, 0.1);
  color: white;
}

.contact-form .form-control::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

.contact-form .form-control:focus {
  outline: none;
  background: rgba(255, 255, 255, 0.2);
}
@media (max-width: 768px) {
  .contact-section .row {
    flex-direction: column;
  }
}

    
</style>