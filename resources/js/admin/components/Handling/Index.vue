<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h2>Lista wpisów w sekcji hotel dla psów</h2>
                    <router-link
                        class="btn btn-outline-primary btn-sm ml-auto"
                        :to="{ name: 'admin.handling.post.create' }"
                    >
                        Nowy post
                    </router-link>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group d-flex">
                    <router-link
                        class="btn btn-outline-primary btn-lg mx-auto"
                        :to="{ name: 'admin.handling.edit' }"
                    >
                        Edytuj treść sekcji
                    </router-link>
                </div>

                <div v-if="!hasPosts" class="alert alert-info">
                    Brak postów.
                </div>

                <table v-else class="table">
                    <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Zdjecie</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts">
                            <td>{{ post.title }}</td>
                            <td>
                                <a href="#" @click="imageUrl(post.image.id)" class="mr-2">Podgląd</a>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <router-link
                                        class="btn btn-outline-primary ml-auto"
                                        :to="{ name: 'admin.handling.post.edit', params: { id: post.id } }"
                                    >
                                        Edytuj
                                    </router-link>
                                    <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id)">Usuń</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            posts: {},
            loading: false
        }
    },

    mounted() {
        this.fetchHandlingPosts();
    },

    computed: {
        hasPosts() {
            return this.posts.length > 0;
        }
    },

    methods: {
        imageUrl(imageId) {
            window.location.href = `/image/${imageId}`
        },

        fetchHandlingPosts() {
            axios.get('/json/admin/handling/edit')
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
                axios.delete(`/json/admin/groohandlingming/post/${id}`)
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: `Usunięto post`
                    })
                    this.fetchHandlingPosts();
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
