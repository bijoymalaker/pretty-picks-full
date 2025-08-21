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
              <Link :href="route('admin.users')" class="nav-link text-white active">
                <i class="fas fa-users me-2"></i>
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
            <h1 class="h3 mb-0">User Management</h1>
            <div class="text-muted">
              Total Users: {{ users.length }}
            </div>
          </div>

          <!-- Users Table -->
          <div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Admin</th>
                      <th>Created At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                      <td>{{ user.id }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>
                        <span class="badge" :class="user.role === 'admin' ? 'bg-success' : 'bg-secondary'">
                          {{ user.role }}
                        </span>
                      </td>
                      <td>
                        <span class="badge" :class="user.is_admin ? 'bg-danger' : 'bg-secondary'">
                          {{ user.is_admin ? 'Yes' : 'No' }}
                        </span>
                      </td>
                      <td>{{ new Date(user.created_at).toLocaleDateString() }}</td>
                      <td>
                        <button class="btn btn-sm btn-info me-1" @click="editUser(user)">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" @click="deleteUser(user)">
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
  users: Array<{
    id: number
    name: string
    email: string
    role: string
    is_admin: boolean
    created_at: string
  }>
}>()

const form = useForm({})

function logout() {
  form.post(route('logout'))
}

function editUser(user: any) {
  alert('Edit user: ' + user.name)
  // Implement edit functionality
}

function deleteUser(user: any) {
  if (confirm('Are you sure you want to delete user: ' + user.name + '?')) {
    // Implement delete functionality
    alert('User deleted: ' + user.name)
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
