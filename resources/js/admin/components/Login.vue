<template>
    <div>
        <div class="d-flex w-50 m-auto align-items-center">
            <div class="card card-body">
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="name">Login</label>
                        <input class="form-control" type="text" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło</label>
                        <input class="form-control" type="password" v-model="password">
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" :disabled="loading">Zaloguj się</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { logIn } from './../auth/auth.js'

export default {
    data() {
        return {
            name: '',
            password: '',
            loading: false,
        }
    },

    methods: {
        login() {
            this.loading = true;
            axios.get('/sanctum/csrf-cookie').then(_ => {
                axios.post('/login', {
                    name: this.name,
                    password: this.password
                })
                .then(_ => {
                    this.fetchUser();
                })
                .catch((error) => {
                    this.$notify({
                        type: 'error',
                        title: 'Error',
                        text: 'Podane dane są nieprawidłowe.'
                    });
                })
                .then(_ => {
                    this.loading = false;
                });
            });
        },

        fetchUser() {
            axios.get(`/json/user`)
            .then((response) => {
                logIn()
                this.$store.dispatch('loadUser', _.get(response.data, 'data', {}));
                this.$router.push({name: 'admin.index'})
            })
            .catch((error) => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak.'
                });
                this.$store.dispatch('logout');
            })
        },
    }
};
</script>
