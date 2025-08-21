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
              <Link :href="route('admin.dashboard')" class="nav-link text-white" :class="{ 'active': $page.url === '/admin/dashboard' }">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.users')" class="nav-link text-white" :class="{ 'active': $page.url === '/admin/users' }">
                <i class="fas fa-users me-2"></i>
                Users
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.products')" class="nav-link text-white" :class="{ 'active': $page.url === '/admin/products' }">
                <i class="fas fa-shopping-bag me-2"></i>
                Products
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.blogs')" class="nav-link text-white" :class="{ 'active': $page.url === '/admin/blogs' }">
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
            <h1 class="h3 mb-0">Admin Dashboard</h1>
            <div class="text-muted">
              Welcome back, {{ $page.props.auth.user.name }}!
            </div>
          </div>

          <!-- Stats Cards -->
          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Users
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ stats.totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Products
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ stats.totalProducts }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Total Blogs
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ stats.totalBlogs }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-blog fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Admin Users
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ stats.adminUsers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="row">
            <div class="col-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <Link :href="route('admin.users')" class="btn btn-primary btn-block">
                        <i class="fas fa-users me-2"></i>
                        Manage Users
                      </Link>
                    </div>
                    <div class="col-md-3 mb-3">
                      <Link :href="route('admin.products')" class="btn btn-success btn-block">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Manage Products
                      </Link>
                    </div>
                    <div class="col-md-3 mb-3">
                      <Link :href="route('admin.blogs')" class="btn btn-info btn-block">
                        <i class="fas fa-blog me-2"></i>
                        Manage Blogs
                      </Link>
                    </div>
                    <div class="col-md-3 mb-3">
                      <Link :href="route('products.create')" class="btn btn-warning btn-block">
                        <i class="fas fa-plus me-2"></i>
                        Add Product
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineProps<{
  stats: {
    totalUsers: number
    totalProducts: number
    totalBlogs: number
    adminUsers: number
  }
}>()

const form = useForm({})

function logout() {
  form.post(route('logout'))
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
