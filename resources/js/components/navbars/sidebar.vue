<template>
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <router-link to="#" class="brand-link">
            <img :src="'/img/bghmc.png'" alt="BGHMC Logo" class="brand-image img-circle elevation-5" style="opacity: 1">
          <span class="brand-text font-weight-light">PMIS</span>
        </router-link>
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
            </div>
            <div class="dark">
            <span v-if="user.employee">{{ user.employee.firstname }} {{ user.employee.lastname }}</span>
              <span v-else></span>
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
                    <router-link to='../../mds_consignments' class="nav-link">
                        <i class="nav-icon fas fa-notes-medical"></i>
                        <p>Med.Supplies Consignment</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../consignment_requests' class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Consignment Requests</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '2'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../pr_dmd' class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Purchase Request</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../drugs_and_medicines' class="nav-link">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>Drugs And Medicines</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../apps' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>APP</p>
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <router-link to='../../ppmps' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>PPMP</p>
                    </router-link>
                </li> -->
                <li class="nav-item">
                    <router-link to='../../price_schedules' class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Price Schedules</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../mds_consignments' class="nav-link">
                        <i class="nav-icon fas fa-medkit"></i>
                        <p>Med.Supplies Consignment</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../consignment_requests' class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Consignment Requests</p>
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <router-link to='../../consignments' class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>Consignments</p>
                    </router-link>
                </li> -->
                <!-- <li class="nav-item">
                    <router-link to='../../suppliers' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Supplier</p>
                    </router-link>
                </li> -->

            </ul>
            <ul v-show="user.role_id === '3'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../pmo_pr' class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Purchase Request</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../request_for_quotation' class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Request For Quotation</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../pmo_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../apps' class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>APP</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../ppmps' class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
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
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Supplier</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '4'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../mmo_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <router-link to='../../dmd_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order 2</p>
                    </router-link>
                </li> -->
                <li class="nav-item">
                    <router-link to='../../mmo_dmd' class="nav-link">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>Drugs and Medicines</p>
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <router-link to='../../verified_reports' class="nav-link">
                        <i class="nav-icon fas fa-file-excel"></i>
                        <p>Terminated</p>
                    </router-link>
                </li> -->
                <li class="nav-item">
                    <router-link to='../../mmo_iar' class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>List of IAR</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../mmo_dvs' class="nav-link">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>List of DV</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '5'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../cmps_pr' class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Purchase Request</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../cmps_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../cmps_dmd' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Drugs and Medicines</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '6'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../budget_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../budget_dmd' class="nav-link">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>Drugs And Medicines</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '7'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../accounting_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../accounting_dmd' class="nav-link">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>Drugs and Medicines</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '8'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../fmo_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '9'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../mcc_po' class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Purchase Order</p>
                    </router-link>
                </li>
            </ul>
            <ul v-show="user.role_id === '10'" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to='../../dashboard' class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../mds_consignments' class="nav-link">
                        <i class="nav-icon fas fa-notes-medical"></i>
                        <p>Med.Supplies Consignment</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to='../../consignment_requests' class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Consignment Requests</p>
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