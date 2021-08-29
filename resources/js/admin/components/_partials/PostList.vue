<template>
    <div>
        <h3>Hotel dla psów</h3>

        <div v-if="!hasDogHotelPosts" class="alert alert-info">
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
                <tr v-for="post in dogHotelPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <a href="#" @click="imageUrl(post.image.id)" class="mr-2">Podgląd</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <slot></slot>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id)">Usuń</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <h3>Handling</h3>

        <div v-if="!hasHandlinglPosts" class="alert alert-info">
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
                <tr v-for="post in handlingPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <a href="#" @click="imageUrl(post.image.id)" class="mr-2">Podgląd</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <slot></slot>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id)">Usuń</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <h3>Grooming</h3>

        <div v-if="!hasGroomingPosts" class="alert alert-info">
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
                <tr v-for="post in groomingPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <a href="#" @click="imageUrl(post.image.id)" class="mr-2">Podgląd</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <slot></slot>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id)">Usuń</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <h3>Fizjoterapia</h3>

        <div v-if="!hasPhysiotherapyPosts" class="alert alert-info">
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
                <tr v-for="post in physiotherapyPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <a href="#" @click="imageUrl(post.image.id)" class="mr-2">Podgląd</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <slot></slot>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id)">Usuń</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            dogHotelPosts: {},
            handlingPosts: {},
            groomingPosts: {},
            physiotherapyPosts: {},
        }
    },

    mounted() {
        this.fetchDogHotelPosts();
        this.fetchHandlinglPosts();
        this.fetchGroomingPosts();
        this.fetchPhysiotherapyPosts();
    },

    computed: {
        hasDogHotelPosts() {
            return this.dogHotelPosts.length > 0;
        },
        hasHandlinglPosts() {
            return this.handlingPosts.length > 0;
        },
        hasGroomingPosts() {
            return this.groomingPosts.length > 0;
        },
        hasPhysiotherapyPosts() {
            return this.physiotherapyPosts.length > 0;
        }
    },

    methods: {
        imageUrl(imageId) {
            window.location.href = `/image/${imageId}`
        },

        fetchDogHotelPosts() {
            axios.get('/json/admin/dog-hotel/edit')
            .then((response) => {
                this.dogHotelPosts = _.get(response.data, 'data.posts', {});
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        fetchHandlinglPosts() {
            axios.get('/json/admin/handling/edit')
            .then((response) => {
                this.handlingPosts = _.get(response.data, 'data.posts', {});
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        fetchGroomingPosts() {
            axios.get('/json/admin/grooming/edit')
            .then((response) => {
                this.groomingPosts = _.get(response.data, 'data.posts', {});
            })
            .catch(_ => {
                 this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Coś poszło nie tak podczas pobierania usług.'
                });
            })
        },

        fetchPhysiotherapyPosts() {
            axios.get('/json/admin/physiotherapy/edit')
            .then((response) => {
                this.physiotherapyPosts = _.get(response.data, 'data.posts', {});
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