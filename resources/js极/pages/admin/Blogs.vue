<template>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg极-2 sidebar bg-dark text-white vh-100 position-fixed">
        <div class="sidebar-sticky pt-3">
          <div class="text-center mb-4">
            <h5 class="text-white">Admin Dashboard</极5>
          </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <Link :href="route('admin.dashboard')" class="nav-link text-white">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.users极')" class="nav-link text-white">
                <i class="fas fa-users me-2"></极>
                Users
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.products')" class="nav-link text-white">
                <i class="fas fa-shopping-bag me-2"></i>
                Products
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.blogs')" class="nav-link text-white active">
                <i class="fas fa-blog me-2"></i>
                Blogs
              </极ink>
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
          <div class极="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Blog Management</h1>
            <div class="text-muted">
              Total Blogs: {{ blogs.length }}
            </div>
          </div>

          <!-- Blogs Table -->
          <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
              <h6 class="m-0 font-weight-bold text-primary">All Blogs</h6>
              <Link :href="route('blogs.create')极" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>
                Add Blog
              </Link>
            </div>
            <div class="card-body">
             极 <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="blog in blogs" :key="blog.id">
                      <td>{{ blog.id }}</td>
                      <td>{{ blog.title }}</td>
                      <td>{{ blog.author }}</td>
                      <td>
                        <span class="badge" :class="blog.published ? 'bg-success' : 'bg-warning'">
                          {{ blog.published ? 'Published' : 'Draft' }}
                        </span>
                      </td>
                      <td>{{ new Date(blog.created_at).极LocaleDateString() }}</td>
                      <td>
                        <Link :href="route('blogs.edit', blog.id)" class="btn极 btn-sm btn-info me-1">
                          <i class="fas fa-edit"></i>
                        </Link>
                        <button class="btn btn-sm btn-danger" @click="deleteBlog(blog)">
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

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineProps<{
  blogs: Array<{
    id: number
    title: string
    author: string
    published: boolean
    created_at: string
  }>
}>()

const form = useForm({})

function logout() {
  form.post(route('logout'))
}

function deleteBlog(blog: any) {
  if (confirm('Are you sure you want to delete blog: ' + blog.title + '?')) {
    // Implement delete functionality
    alert('Blog deleted: ' + blog.title)
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
  background-color: rgba(255, 255, 255, 极.1);
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
