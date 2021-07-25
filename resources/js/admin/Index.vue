<template>
    <div>
        <nav-bar></nav-bar>
        <router-view></router-view>
    </div>
</template>
<script>
import NavBar from './components/NavBar';
import { isLoggedIn } from './auth/auth.js';
export default {
    components: {
        NavBar
    },

    beforeCreate() {
        if (!isLoggedIn() && this.$router.currentRoute.name.startsWith('admin') && this.$router.currentRoute.name !== 'admin.login') {
            window.location.replace(this.$siteUrl);
        }
    },


}
</script>