<template>
    <div class="w-25">
        <div>Registration page</div>
        <div class="form-group mb-3">
            <input v-model="name" type="text" class="form-control" placeholder="name">
            <small v-if="errors.name" class="text-danger">{{errors.name}}</small>
        </div>
        <div class="form-group mb-3">
            <input v-model="email" type="email" class="form-control" placeholder="email">
            <small v-if="errors.email" class="text-danger">{{errors.email}}</small>
        </div>
        <div class="form-group mb-3">
            <input v-model="password" type="password" class="form-control" placeholder="password">
            <small v-if="errors.password" class="text-danger">{{errors.password}}</small>
        </div>
        <div class="form-group mb-3">
            <input v-model="password_confirmation" type="password" class="form-control" placeholder="confirm password">
        </div>
        <input type="submit" @click.prevent="store" class="btn btn-primary" value="Регистрация">
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Registration",

    data(){
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            errors: {
                name: null,
                email: null,
                password: null,
            }
        }
    },

    methods:{
        store(){
            this.errors.name = null
            this.errors.email = null
            this.errors.password = null
            axios.post('/api/users', {name: this.name, email:this.email, password: this.password, password_confirmation: this.password_confirmation})
                .then(res => {
                    localStorage.setItem('access_token', res.data.access_token)
                    this.$router.push({name: 'user.personal'})
                }).catch(error => {
                    console.log(error.response.data.errors);
                    if (error.response.data.errors.name){
                        this.errors.name = error.response.data.errors.name[0]
                    }
                    if (error.response.data.errors.email){
                        this.errors.email = error.response.data.errors.email[0]
                    }
                    if (error.response.data.errors.password){
                        this.errors.password = error.response.data.errors.password[0]
                    }
            })
        }
    }
}
</script>

<style scoped>

</style>
