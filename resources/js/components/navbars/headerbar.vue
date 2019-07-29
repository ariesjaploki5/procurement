<template>
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
          <!-- <li class="nav-item d-none d-sm-inline-block">
            <router-link to='/home' class="nav-link">Home</router-link>
          </li> -->
          
        </ul>
        <h3><span class="ml-2 mr-2 text-right">Office:</span></h3>
        <ul class="navbar-nav">
          <div class="badge badge-success text-wrap text-center align-bottom">
            <h5>
              <span v-show="current_user.role_id == 1">Administrator</span>
              <span v-show="current_user.role_id == 2">Pharmacy</span>
              <span v-show="current_user.role_id == 3">Procumement Management Office</span>
              <span v-show="current_user.role_id == 4">Materials Managment Office</span>
              <span v-show="current_user.role_id == 5">Division Head</span>
              <span v-show="current_user.role_id == 6">Budget Office</span>
              <span v-show="current_user.role_id == 7">Accounting Office</span>
              <span v-show="current_user.role_id == 8">Finance Management Office</span>
              <span v-show="current_user.role_id == 9">Medical Center Chief</span>
            </h5>
          </div>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-user-alt mr-2"></i><span v-if="user.employee">{{ user.employee.firstname }} {{ user.employee.lastname }}</span>
              <span v-else></span>
              <i class="fa fa-bell-o"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="logout" @click.prevent="logout" class="dropdown-item">
                  <i class="fas fa-sign-out-alt"></i>
                  Logout
              </a>
            </div>
            
          </li>
        </ul>
      </nav>
</template>

<script>
    export default {
        name: 'app-header',
        data(){
          return{
            user: {},
          }
        },
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