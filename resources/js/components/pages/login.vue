<template>
    <div class="login row justify-content-center mt-2">
        <div class="col-lg-3 col-md-6 col-sm-8">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img :src="'/img/BGHMC_LOGO.gif'" alt="BGHMC Logo" style="opacity: 1" width="250px" height="250px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-title text-center">
                                Procurement
                            </div>
                            <form @submit.prevent="authenticate">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="username" v-model="form.username" class="form-control form-control-sm" placeholder="Username" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" v-model="form.password" class="form-control form-control-sm" placeholder="Password" required>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" value="Login" class="btn btn-primary btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {login} from '../../store/helpers/auth';
    export default {
        name: "login",
        data() {
            return {
                form: {
                    username: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');
                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/home'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            
        }
    }
</script>
