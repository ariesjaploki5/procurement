

export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const current_user = store.state.current_user;


        if(requiresAuth && !current_user) {
            next('/');
        } else if(to.path == '/' && current_user) {
            next('/home');
        } else {
            next();
        }
    });
    
    axios.interceptors.response.use(null, (error) => {{
        if (error.response.status == 401) 
            store.commit('logout');
            router.push('/');
        }

        return Promise.reject(error);
    });

    if (store.getters.current_user) {
        setAuthorization(store.getters.current_user.token);
    }
}

export function setAuthorization(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
}