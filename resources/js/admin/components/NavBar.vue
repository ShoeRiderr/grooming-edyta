<template>
    <div>
        <notifications position="top center" width="50%"/>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-4">
            <router-link class="navbar-brand" :to="{ name: 'admin.index' }">
                CMS Admin Panel
            </router-link>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'admin.contact' }">
                            Kontakt
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'admin.about-company' }">
                            O firmie
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'admin.service.index' }">
                            Usługi
                        </router-link>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="">Posty</a>
                    </li>
                    <!-- <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="" @click.prevent="logOut">Wyloguj</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>

export default {
    // props: {
    //     isLoggedIn: {
    //         required: true
    //     }
    // },

    // methods: {
    //     async logOut() {
    //         try {
    //             await axios.post('/logout');
    //             this.$store.dispatch('logout');
    //             this.$router.push({ name: 'index' });
    //         } catch (error) {
    //             this.$store.dispatch('logout');
    //             this.$router.push({ name: 'index' });
    //         }
    //     }
    // }
}
</script>
