<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Aktualności
            </div>
            <div class="card-body">
                <h2>Sekcja dodawania postów:</h2>
                <div class="d-flex flex-wrap justify-content-center mb-5">
                    <router-link
                        class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                        :to="{ name: 'admin.dogHotel.post.create' }"
                    >
                        Hotel dla psów
                    </router-link>
                    <router-link
                        class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                        :to="{ name: 'admin.grooming.post.create' }"
                    >
                        Grooming
                    </router-link>
                    <router-link
                        class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                        :to="{ name: 'admin.handling.post.create' }"
                    >
                        Handling
                    </router-link>
                    <router-link
                        class="btn btn-outline-primary ml-2 mb-2 btn-lg"
                        :to="{ name: 'admin.physiotherapy.post.create' }"
                    >
                        Fizjoterapia
                    </router-link>
                </div>
                <post-list></post-list>
            </div>
        </div>
    </div>
</template>
<script>
import PostList from '@admin/components/_partials/PostList';

export default {
    components: {
        PostList
    },

    data() {
        return {

        }
    },

    methods: {
        imageUrl(imageId) {
            window.location.href = `/image/${imageId}`
        },

        fetchDogHotelPosts() {
            axios.get('/json/admin/dog-hotel/edit')
            .then((response) => {
                this.posts = _.get(response.data, 'data.posts', {});
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        onDelete(id) {
            this.loading = true;

            if(confirm(`Czy na pewno chcesz usunąć post?`)) {
                axios.delete(`/json/admin/dog-hotel/post/${id}`)
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: `Usunięto post`
                    })
                    this.fetchDogHotelPosts();
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
        },
    }
};
</script>