<template>
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <router-link to="#" class="brand-link">
            <img :src="'/img/bghmc.png'" alt="BGHMC Logo" class="brand-image img-circle elevation-5" style="opacity: 1">
          <span class="brand-text font-weight-light">Procurement</span>
        </router-link>
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
            </div>
            <div class="dark">
                {{ current_user.username }}
            </div>
          </div>
          <nav class="mt-2">
            <ul v-show="user.role_id === '1'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../dashboard' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../users' class="nav-link">
                        <i class="nav-icon fab fa-first-order"></i>
                        <p>Users</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '2'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../purchase_request2' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Purchase Request</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../drugs_and_medicines' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Drugs And Medicines</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../apps' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>APP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../ppmps' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>PPMP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../price_schedules' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>Price Schedules</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../suppliers' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Supplier</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../users' class="nav-link">
                        <i class="nav-icon fab fa-first-order"></i>
                        <p>Users</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '3'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../purchase_request2' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Purchase Request</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../purchase_order2' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../apps' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>APP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../ppmps' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>PPMP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../price_schedules' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>Price Schedules</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../suppliers' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Supplier</p>
                    </router-link>
                </li>
                
            </ul>
            <ul v-show="user.role_id === '5'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../purchase_request2' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Purchase Request</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../purchase_order2' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                
            </ul>
            <ul v-show="user.role_id === '7'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../purchase_order2' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
    export default {
        data(){
            return{
                user: {},
            }
        },
        name: 'app-sidebar',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/');
            },
            get_user(){
                axios.get('../../api/user/'+this.current_user.user_id).then(({data}) => {
                    this.user = data;
                }).catch(() => {

                });
            },
        },
        created(){
            this.get_user();
        },
        computed: {
            current_user() {
                return this.$store.getters.current_user;
            }
        }
    }
</script>