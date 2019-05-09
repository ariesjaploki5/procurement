<template>
    <div>
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <router-link to='/home' class="nav-link">Home</router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              {{ current_user.username }}
              <i class="fa fa-bell-o"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="logout" @click.prevent="logout" class="dropdown-item">
                  <i class="nav-icon fas fa-power-off"></i>
                  Logout
              </a>
            </div>
            
          </li>
        </ul>
      </nav>
        <aside class="main-sidebar sidebar-light-primary elevation-4">
        <router-link to="#" class="brand-link">
        <!-- Brand Logo -->
            <img :src="'../../img/bghmc.png'" alt="BGHMC Logo" class="brand-image img-circle elevation-5"
                 style="opacity: 1">
          <span class="brand-text font-weight-light">Item Management</span>
        </router-link>
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
              <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="dark">
                {{ current_user.username }}
            </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item">
                <router-link to='home' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </router-link>
              </li>
              <!-- <li class="nav-item">
                <router-link to='procurement' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Procurement</p>
                </router-link>
              </li> -->
              <li class="nav-item" v-show="current_user.roled_id == 10 || current_user.role_id == 2 || current_user.role_id == 3|| current_user.role_id == 8">
                <router-link to='purchase_requests' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Purchase Requests</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to='purchase_orders' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Purchase Orders</p>
                </router-link>
              </li>
              
              <li class="nav-item">
                <router-link to='inventory' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Inventory</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='price_schedules' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Price Schedules</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='document_tracking' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Document Tracking</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='plan' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Plan</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='app' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>APP</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='print_app' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>print_app</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='ppmp' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>PPMP</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='users' class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Users</p>
                </router-link>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
  </aside>
    </div>
</template>

<script>
export default {
        name: 'app-sidebar',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/');
            }
        },
        computed: {
            current_user() {
                return this.$store.getters.current_user;
            }
        }
    }
</script>

<style>

</style>
