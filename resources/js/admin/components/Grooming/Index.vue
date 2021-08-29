<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h2>Lista wpisów w sekcji grooming</h2>
                    <router-link
                        class="btn btn-outline-primary btn-sm ml-auto"
                        :to="{ name: 'admin.grooming.image.create' }"
                    >
                        Dodaj zdjęcia
                    </router-link>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group d-flex">
                    <router-link
                        class="btn btn-outline-primary btn-lg mx-auto"
                        :to="{ name: 'admin.grooming.edit' }"
                    >
                        Edytuj treść sekcji
                    </router-link>
                </div>

                <div v-if="!hasImages" class="alert alert-info">
                    Brak zdjęć.
                </div>

                <table v-else class="table">
                    <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Opis</th>
                            <th>Zdjecie</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="image in images">
                            <td>{{ image.title }}</td>
                            <td>{{ image.description }}</td>
                            <td>
                                <a href="#" @click="imageUrl(image.id)" class="mr-2">Podgląd</a>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-outline-danger ml-2" @click="onDelete(image.id)">Usuń</button>
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
            images: {},
            loading: false
        }
    },

    mounted() {
        this.fetchGroomingImages();
    },

    computed: {
        hasImages() {
            return this.images.length > 0;
        }
    },

    methods: {
        imageUrl(imageId) {
            window.location.href = `/image/${imageId}`
        },

        fetchGroomingImages() {
            axios.get('/json/grooming')
            .then((response) => {
                this.images = _.get(response.data, 'data.images', {});
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

            if(confirm(`Czy na pewno chcesz usunąć zdjęcie?`)) {
                axios.delete(`/json/admin/grooming/image/${id}`)
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: `Usunięto zdjęcie`
                    })
                    this.fetchGroomingImages();
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
