<template>
    <div class="w-25">
        <div>Login page</div>
        <input type="email" v-model="email" class="form-control mb-3" placeholder="email">
        <input type="password" v-model="password" class="form-control mb-3" placeholder="password">
        <input type="submit" @click.prevent="login" class="btn btn-primary" value="Войти">
    </div>
</template>

<script>
export default {
    name: "login",

    data(){
        return {
            email: null,
            password: null
        }
    },

    methods: {
        login(){
            axios.post('/api/auth/login', {email: this.email, password: this.password})
                .then(res => {
                    localStorage.setItem('access_token', res.data.access_token)
                    this.$router.push({name: 'user.personal'})
                })
        }
    }
}
</script>

<style scoped>

</style>
