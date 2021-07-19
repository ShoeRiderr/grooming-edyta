<template>
    <div>
        <div class="w-50 m-auto">
            <div class="card card-body">
                <form @submit.prevent="logIn">
                    <div class="form-group">
                        <label for="login">Email</label>
                        <input class="form-control" type="text" id="login" v-model="login">
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
            login: '',
            password: '',
            errors: {},
            loading: false,
        }
    },

    methods: {
        logIn() {
            this.loading = true;

            axios.get('/sanctum/csrf-cookie');

            axios.post('/login', {
                login: this.login,
                password: this.password
            })
            .then((response) => {
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
        },

        fetchUser() {
            axios.get(`/api/user`)
            .then((response) => {
                console.log(response.data)
                logIn()
                this.$store.dispatch('loadUser', response.data);
            })
            .catch((error) => {
                console.log(error)
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak.'
                });
                this.$store.dispatch('logout');
            })
        },
    }
}
</script>
