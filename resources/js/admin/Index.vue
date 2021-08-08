<template>
    <div>
        <div v-if="isLoggedIn || this.$router.currentRoute.name === 'admin.login'">
            <nav-bar></nav-bar>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import NavBar from './components/NavBar';
import { isLoggedIn } from './auth/auth.js';
import { mapState } from 'vuex';

export default {
    components: {
        NavBar
    },

    computed: {
        ...mapState({
            isLoggedIn: (state) => state.isLoggedIn
        })
    },
};
</script>