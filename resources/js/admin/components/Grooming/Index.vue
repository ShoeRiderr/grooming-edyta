<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <span>Lista wpisów w sekcji grooming</span>
                    <router-link
                        class="btn btn-outline-primary btn-sm ml-auto"
                        :to="{ name: 'admin.grooming.create' }"
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
            grooming: {},
            groomingPost: {},
            loading: false
        }
    },

    mounted() {
        this.fetchGrooming();
        this.fetchGroomingPost();
    },

    computed: {
        hasGrooming() {
            return this.grooming.data ? this.grooming.data.length > 0 : false;
        }
    },

    methods: {
        fetchGrooming(page = 1) {
            axios.get('/json/admin/grooming')
            .then((response) => {
                this.grooming = _.get(response.data, 'data', {});
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        fetchGroomingPost(page = 1) {
            axios.get('/json/admin/post/grooming?page=' + page)
            .then((response) => {
                this.groomingPost = response.data;
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        deleteGrooming(grooming, id) {
            this.loading = true;

            if(confirm(`Czy na pewno chcesz usunąć wpis ${grooming}?`)) {
                axios.delete(`/json/admin/grooming/${id}`)
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: `Usuniętousługę ${grooming}.`
                    })
                    this.fetchGrooming();
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
