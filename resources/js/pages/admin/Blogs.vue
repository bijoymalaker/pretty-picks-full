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
                Dashboard
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.users')" class="nav-link text-white">
                Users
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.products.index')" class="nav-link text-white">
                Products
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('admin.blogs.index')" class="nav-link text-white active">
                Blogs
              </Link>
            </li>
            <li class="nav-item mt-3">
              <Link :href="route('home')" class="nav-link text-white">
                Back to Site
              </Link>
            </li>
            <li class="nav-item">
              <button @click="logout" class="nav-link text-white btn btn-link text-decoration-none">
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
            <h1 class="h3 mb-0">Blog Management</h1>
            <div class="text-muted">
              Total Blogs: {{ blogs.length }}
            </div>
          </div>

          <!-- Blogs Table -->
          <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
              <h6 class="m-0 font-weight-bold text-primary">All Blogs</h6>
              <Link :href="route('blogs.create')" class="btn btn-primary btn-sm">
                Add Blog
              </Link>
            </div>
            <div class="card-body">
              <div class="table-responsive">
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
                      <td>{{ new Date(blog.created_at).toLocaleDateString() }}</td>
                      <td>
                        <Link :href="route('blogs.edit', blog.id)" class="btn btn-sm btn-info me-1">
                          Edit
                        </Link>
                        <button class="btn btn-sm btn-danger" @click="deleteBlog(blog)">
                          Delete
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
import axios from 'axios'

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

async function deleteBlog(blog: any) {
  if (confirm('Are you sure you want to delete blog: ' + blog.title + '?')) {
    try {
      await axios.delete(`/api/blogs/${blog.id}`); // Use correct API endpoint
      alert('Blog deleted: ' + blog.title);
      // Refresh the blog list by reloading the page or emitting an event
      window.location.reload();
    } catch {
      alert('Failed to delete blog: ' + blog.title);
    }
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
