<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <span>Lista wpisów w sekcji fizjoterapia</span>
                    <router-link
                        class="btn btn-outline-primary btn-sm ml-auto"
                        :to="{ name: 'admin.physiotherapy.create' }"
                    >
                        Dodaj nowy wpis
                    </router-link>
                </div>
            </div>
            <div class="card">
                <div v-if="!hasPhysiotherapies" class="alert alert-info">
                    Brak wpisów.
                </div>
                <ul class="list-group list-group-flush" v-for="physiotherapy in physiotherapy.data" :key="physiotherapy.id">
                    <li class="list-group-item border-bottom">
                        <div class="d-flex">
                            <h4>{{physiotherapy.title}}</h4>
                            <div class="ml-auto">
                                <router-link
                                    class="btn btn-outline-primary btn-sm mr-2"
                                    :to="{ name: 'admin.physiotherapy.edit', params: { physiotherapyId: physiotherapy.id } }"
                                >
                                    Edytuj
                                </router-link>
                                <button
                                    class="btn btn-outline-danger btn-sm"
                                    @click.prevent="deletePhysiotherapy(physiotherapy.title, physiotherapy.id)"
                                    :disabled="loading"
                                >
                                    Usuń
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
                <pagination class="p-4 mb-0 float-right" :data="physiotherapy" @pagination-change-page="fetchPhysiotherapies"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            physiotherapy: {},
            loading: false
        }
    },

    mounted() {
        this.fetchPhysiotherapies();
    },

    computed: {
        hasPhysiotherapies() {
            return this.physiotherapy.data ? this.physiotherapy.data.length > 0 : false;
        }
    },

    methods: {
        fetchPhysiotherapies(page = 1) {
            axios.get('/json/admin/physiotherapy?page=' + page)
            .then((response) => {
                this.physiotherapy = response.data;
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        deletePhysiotherapy(physiotherapy, id) {
            this.loading = true;

            if(confirm(`Czy na pewno chcesz usunąć wpis ${physiotherapy}?`)) {
                axios.delete(`/json/admin/physiotherapy/${id}`)
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: `Usuniętousługę ${physiotherapy}.`
                    })
                    this.fetchPhysiotherapies();
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
