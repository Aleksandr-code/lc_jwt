import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {path: '/', component: () => import('./components/fruit/Index.vue'), name: 'fruit.index'},
    {path: '/users/login', component: () => import('./components/user/Login.vue'), name: 'user.login'},
    {path: '/users/register', component: () => import('./components/user/Registration.vue'), name: 'user.register'},
    {path: '/users/personal', component: () => import('./components/user/Personal.vue'), name: 'user.personal'},
    {path: '/:catchAll(.*)', component: () => import('./components/NotFound.vue'), name: '404'}
]

const router = createRouter({
    history:createWebHistory(),

    routes
})

router.beforeEach((to, from, next) => {
    const accessToken = localStorage.getItem('access_token')

    if (!accessToken){
        if (to.name === 'user.login' || to.name === 'user.register') {
            return next()
        } else {
            return next({name: 'user.login'})
        }
    }
    else if (accessToken){
        if (to.name === 'user.login' || to.name === 'user.register'){
            return next({name: 'user.personal'})
        } else {
            return next()
        }
    }

})

export default router;
