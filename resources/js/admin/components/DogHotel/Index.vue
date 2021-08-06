<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h2>Lista wpisów w sekcji hotel dla psów</h2>
                    <router-link
                        class="btn btn-outline-primary ml-auto"
                        :to="{ name: 'admin.dogHotel.post.create' }"
                    >
                        Dodaj nowy post do hotelu dla psów
                    </router-link>
                </div>
            </div>

            <div class="card">
                <post-index :posts="post"></post-index>
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
            post: {},
            loading: false
        }
    },

    mounted() {
        this.fetchDogHotelPosts();
    },

    computed: {
        hasdogHotel() {
            return this.dogHotel.data ? this.dogHotel.data.length > 0 : false;
        }
    },

    methods: {
        fetchDogHotelPosts() {
            axios.get('/json/post/dog-hotel')
            .then((response) => {
                this.post = _.get(response.data, 'data', {});
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
