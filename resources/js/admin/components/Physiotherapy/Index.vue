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
                <post-index></post-index>
            </div>
        </div>
    </div>
</template>

<script>
import PostIndex from '#/admin/components/_partials/PostIndex';

export default {
    components: {
        PostIndex
    },

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
