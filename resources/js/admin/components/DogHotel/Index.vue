<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <span>Lista wpisów w sekcji hotel dla psów</span>
                    <router-link
                        class="btn btn-outline-primary btn-sm ml-auto"
                        :to="{ name: 'admin.dog-hotel.create' }"
                    >
                        Dodaj nowy wpis
                    </router-link>
                </div>
            </div>
            <div class="card">
                <div v-if="!hasdogHotel" class="alert alert-info">
                    Brak wpisów.
                </div>
                <ul class="list-group list-group-flush" v-for="dogHotel in dogHotel.data" :key="dogHotel.id">
                    <li class="list-group-item border-bottom">
                        <div class="d-flex">
                            <h4>{{dogHotel.title}}</h4>
                            <div class="ml-auto">
                                <router-link
                                    class="btn btn-outline-primary btn-sm mr-2"
                                    :to="{ name: 'admin.dog-hotel.edit', params: { dogHotelId: dogHotel.id } }"
                                >
                                    Edytuj
                                </router-link>
                                <button
                                    class="btn btn-outline-danger btn-sm"
                                    @click.prevent="deleteDogHotel(dogHotel.title, dogHotel.id)"
                                    :disabled="loading"
                                >
                                    Usuń
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
                <pagination class="p-4 mb-0 float-right" :data="dogHotel" @pagination-change-page="fetchDogHotel"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dogHotel: {},
            loading: false
        }
    },

    mounted() {
        this.fetchDogHotel();
    },

    computed: {
        hasdogHotel() {
            return this.dogHotel.data ? this.dogHotel.data.length > 0 : false;
        }
    },

    methods: {
        fetchDogHotel(page = 1) {
            axios.get('/json/admin/dog-hotel?page=' + page)
            .then((response) => {
                this.dogHotel = response.data;
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        deleteDogHotel(dogHotel, id) {
            this.loading = true;

            if(confirm(`Czy na pewno chcesz usunąć wpis ${dogHotel}?`)) {
                axios.delete(`/json/admin/dog-hotel/${id}`)
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: `Usuniętousługę ${dogHotel}.`
                    })
                    this.fetchDogHotel();
                })
                .catch(_ => {
                    this.$notify({
                        type: 'error',
                        title: 'Error',
                        text: 'Wystąpił nieoczekiwany błąd.'
                    });
                })
                .then(_ => {
                    this.loading = false;
                })
            }
        }
    }
};
</script>
