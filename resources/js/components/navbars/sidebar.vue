<template>
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <router-link to="#" class="brand-link">
        <!-- Brand Logo -->
            <img :src="'/img/bghmc.png'" alt="BGHMC Logo" class="brand-image img-circle elevation-5" style="opacity: 1">
          <span class="brand-text font-weight-light">Procurement</span>
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
                    <router-link to='../../dashboard' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../ppmps' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>PPMP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../apps' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>APP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../price_schedules' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>Price Schedules</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../purchase_requests' class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Purchase Requests</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../purchase_orders' class="nav-link">
                        <i class="nav-icon fab fa-first-order"></i>
                        <p>Purchase Orders</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../inventory' class="nav-link">
                        <i class="nav-icon fab fa-first-order"></i>
                        <p>Inventory</p>
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <a href="logout" @click.prevent="logout" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li> -->
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
  </aside>
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