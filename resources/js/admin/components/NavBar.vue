<template>
    <div>
        <notifications position="top center" width="50%"/>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-4">
            <router-link class="navbar-brand" :to="{ name: 'admin.index' }">
                Panel Admina
            </router-link>
            <div class="collapse navbar-collapse" id="navbarNav" v-if="isLoggedIn">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Strona główna</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="" @click.prevent="logOut">Wyloguj</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
    computed: {
        ...mapState({
            isLoggedIn: (state) => state.isLoggedIn
        })
    },

    methods: {
        async logOut() {
            try {
                await axios.post('/logout');
                this.$store.dispatch('logout');
                window.location.href = '/';
            } catch (error) {
                this.$store.dispatch('logout');
                window.location.href = '/';
            }
        }
    }
};
</script>
