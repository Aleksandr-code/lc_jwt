<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'fruit.index'}">List</router-link>
                </li>
                <li class="nav-item" v-if="!accessToken">
                    <router-link class="nav-link" :to="{name: 'user.login'}">Login</router-link>
                </li>
                <li class="nav-item" v-if="!accessToken">
                    <router-link class="nav-link" :to="{name: 'user.register'}">Registration</router-link>
                </li>
                <li class="nav-item" v-if="accessToken">
                    <router-link class="nav-link" :to="{name: 'user.personal'}">Personal</router-link>
                </li>
                <li class="nav-item" v-if="accessToken">
                    <a href="#" class="nav-link" @click.prevent="logout">Logout</a>
                </li>
            </ul>
        </nav>
        <router-view :key="$route.fullPath"  class="pt-3"></router-view>
    </div>
</template>

<script>

import API from "../api";

export default {
    name: "Index",

    data(){
        return {
            accessToken: null
        }
    },

    mounted() {
        this.getAccessToken()
    },

    updated() {
        this.getAccessToken()
    },

    methods:{
        getAccessToken(){
            this.accessToken = localStorage.getItem('access_token')
        },
        logout(){
            API.post('api/auth/logout')
                .then(res => {
                    localStorage.removeItem('access_token')
                    this.$router.push({name:'user.login'})
                })
        }

    }

}
</script>

<style scoped>

</style>
