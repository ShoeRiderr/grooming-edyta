<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Dane użytkownika
                    </div>
                    <form @submit.prevent="updateUser">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label for="name">Imię</label>
                                    <input v-model="user.name" class="form-control" type="text" id="name" :disabled="!canEditUser">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="user.email" class="form-control" type="email" id="email" :disabled="!canEditUser">
                                </div>
                            </li>
                            <li class="list-group-item" v-if="canEditUser">
                                <div class="form-group">
                                    <label for="password">Hasło</label>
                                    <input v-model="password" class="form-control" type="password" id="password" name="password">
                                </div>
                            </li>
                            <li class="list-group-item" v-if="canEditUser">
                                <div class="form-group">
                                    <label for="password_confirmation">Potwierdź hasło</label>
                                    <input v-model="password_confirmation" class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                </div>
                            </li>
                        </ul>
                        <div class="card-footer d-flex">
                            <button class="btn btn-outline-secondary ml-auto" @click.prevent="canEditUser = true" :class="editNotAllow">Przejdź do edycji</button>

                            <button class="btn btn-outline-secondary" @click.prevent="canEditUser = false" :class="editAllow" :disabled="loading">Anuluj</button>
                            <button type="submit" class="btn btn-primary ml-auto" :class="editAllow" :disabled="loading">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Strona główna
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <router-link
                                class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                                :to="{ name: 'admin.grooming.index' }"
                            >
                                Grooming
                            </router-link>
                            <router-link
                                class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                                :to="{ name: 'admin.dogHotel.index' }"
                            >
                                Hotel dla psów
                            </router-link>
                            <router-link
                                class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                                :to="{ name: 'admin.physiotherapy.index' }"
                            >
                                Fizjoterapia
                            </router-link>
                            <router-link
                                class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                                :to="{ name: 'admin.aboutCompany.edit' }"
                            >
                                O sobie
                            </router-link>
                            <router-link
                                class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                                :to="{ name: 'admin.contact.edit' }"
                            >
                                Kontakt
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            canEditUser: false,
            loading: false,
            password: '',
            password_confirmation: '',
        }
    },

    computed: {
        ...mapState({
            user: 'user'
        }),

        editAllow() {
            return this.canEditUser === true ? 'd-block' : 'd-none';
        },

        editNotAllow() {
            return this.canEditUser === true ? 'd-none' : 'd-block';
        }
    },

    methods: {
        updateUser() {
            this.loading = true;

            axios.put(`/json/admin/user/${this.user.id}`, {
                name: this.user.name,
                email: this.user.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then((response) => {
                this.$notify({
                    type: 'success',
                    title: 'Sukces',
                    text: 'pomyślnie edytowano admina.'
                });
            })
            .catch((error) => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas edycji admina.'
                });
            })
            .then(_ => {
                this.loading = false;
                this.canEditUser = false;
                this.password = '';
                this.password_confirmation = '';
            })
        },
    }
};
</script>
