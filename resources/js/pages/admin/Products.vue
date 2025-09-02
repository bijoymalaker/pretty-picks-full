<template>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 sidebar bg-dark text-white vh-100 position-fixed">
        <div class="sidebar-sticky pt-3">
          <div class="text-center mb-4">
            <h5 class="text-white">Admin Dashboard</h5>
          </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <Link :href="route('admin.dashboard')" class="nav-link text-white">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.users')" class="nav-link text-white">
                <i class="fas fa-users me-2"></i>
                Users
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.products')" class="nav-link text-white active">
                <i class="fas fa-shopping-bag me-2"></i>
                Products
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.blogs')" class="nav-link text-white">
                <i class="fas fa-blog me-2"></i>
                Blogs
              </Link>
            </li>
            <li class="nav-item mt-3">
              <Link :href="route('home')" class="nav-link text-white">
                <i class="fas fa-home me-2"></i>
                Back to Site
              </Link>
            </li>
            <li class="nav-item">
              <button @click="logout" class="nav-link text-white btn btn-link text-decoration-none">
                <i class="fas fa-sign-out-alt me-2"></i>
                Logout
              </button>
            </li>
          </ul>
        </div>
      </div>

      <!-- Main content -->
      <div class="col-md-9 col-lg-10 ms-auto">
        <div class="container-fluid py-4">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Product Management</h1>
            <div class="text-muted">
              Total Products: {{ products.length }}
            </div>
          </div>

          <!-- Products Table -->
          <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
              <h6 class="m-5 font-weight-bold text-primary">All Products</h6>
              <Link :href="route('products.index')" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>
                Add Product
              </Link>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Collection</th>
                      <th>Created At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in products" :key="product.id">
                      <td>{{ product.id }}</td>
                      <td>{{ product.name }}</td>
                      <td>${{ product.price }}</td>
                      <td>{{ product.collection }}</td>
                      <td>{{ new Date(product.created_at).toLocaleDateString() }}</td>
                      <td>
                        <Link :href="route('products.edit', product.id)" class="btn btn-sm btn-info me-1">
                          <i class="fas fa-edit"></i>
                        </Link>
                        <button class="btn btn-sm btn-danger" @click="deleteProduct(product)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineProps({
  products: Array
})

const form = useForm({})

function logout() {
  form.post(route('logout'))
}

function deleteProduct(product) {
  if (confirm('Are you sure you want to delete product: ' + product.name + '?')) {
    form.delete(route('products.destroy', product.id), {
      onSuccess: () => {
        alert('Product deleted: ' + product.name);
        // Inertia will automatically handle the page refresh
      },
      onError: () => {
        alert('Failed to delete product: ' + product.name);
      }
    });
  }
}
</script>

<style scoped>
.sidebar {
  width: 250px;
  left: 0;
  top: 0;
  padding-top: 56px;
}

.nav-link.active {
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 4px;
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.05);
  border-radius: 4px;
}

.btn-link:hover {
  background-color: rgba(255, 255, 255, 0.05);
  border-radius: 4px;
}
</style>
