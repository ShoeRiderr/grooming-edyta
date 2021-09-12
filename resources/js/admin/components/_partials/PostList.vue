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
                    <th>Data zakończenia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in dogHotelPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <img :src="imageSrc(post.image.file_pathname)" alt="photo">
                    </td>
                    <td>{{ post.end_date }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <router-link
                                class="btn btn-outline-primary btn-sm"
                                :to="{ name: 'admin.dogHotel.post.edit', params: {id: post.id} }"
                            >
                                Edytuj post
                            </router-link>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id, 1)">Usuń</button>
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
                    <th>Data zakończenia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in handlingPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <img :src="imageSrc(post.image.file_pathname)" alt="photo">
                    </td>
                    <td>{{ post.end_date }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <router-link
                                class="btn btn-outline-primary btn-sm"
                                :to="{ name: 'admin.handling.post.edit', params: { id: post.id } }"
                            >
                                Edytuj post
                            </router-link>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id, 2)">Usuń</button>
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
                    <th>Data zakończenia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in groomingPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <img :src="imageSrc(post.image.file_pathname)" alt="photo">
                    </td>
                    <td>{{ post.end_date }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <router-link
                                class="btn btn-outline-primary btn-sm"
                                :to="{ name: 'admin.grooming.post.edit', params: { id: post.id } }"
                            >
                                Edytuj post
                            </router-link>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id, 3)">Usuń</button>
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
                    <th>Data zakończenia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in physiotherapyPosts">
                    <td>{{ post.title }}</td>
                    <td>
                        <img :src="imageSrc(post.image.file_pathname)" alt="photo">
                    </td>
                    <td>{{ post.end_date }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <router-link
                                class="btn btn-outline-primary btn-sm"
                                :to="{ name: 'admin.physiotherapy.post.edit', params: { id: post.id } }"
                            >
                                Edytuj post
                            </router-link>
                            <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(post.id, 4)">Usuń</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import imageSrc from '@admin/mixins/imageSrc.js';

export default {
    mixins: [imageSrc],

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
        fetchDogHotelPosts() {
            axios.get('/json/admin/dog-hotel')
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
            axios.get('/json/admin/handling')
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
            axios.get('/json/admin/grooming')
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
            axios.get('/json/admin/physiotherapy')
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

        onDelete(id, sectionType) {
            this.loading = true;

            if(confirm(`Czy na pewno chcesz usunąć post?`)) {
                switch (sectionType) {
                    case 1:
                        axios.post(`/json/admin/dog-hotel/post/${id}`, {
                            _method: "DELETE"
                        })
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
                        });
                        break;
                    case 2:
                        axios.post(`/json/admin/handling/post/${id}`,{
                            _method: "DELETE"
                        })
                        .then(_ => {
                            this.$notify({
                                type: 'success',
                                title: 'Sukces',
                                text: `Usunięto post`
                            })
                            this.fetchHandlinglPosts();
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
                        });
                        break;
                    case 3:
                        axios.post(`/json/admin/grooming/post/${id}`,{
                            _method: "DELETE"
                        })
                        .then(_ => {
                            this.$notify({
                                type: 'success',
                                title: 'Sukces',
                                text: `Usunięto post`
                            })
                            this.fetchGroomingPosts();
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
                        });
                        break;
                    case 4:
                        axios.post(`/json/admin/physiotherapy/post/${id}`,{
                            _method: "DELETE"
                        })
                        .then(_ => {
                            this.$notify({
                                type: 'success',
                                title: 'Sukces',
                                text: `Usunięto post`
                            })
                            this.fetchPhysiotherapyPosts();
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
                        });
                        break;
                }
            }
        },
    }
};
</script>