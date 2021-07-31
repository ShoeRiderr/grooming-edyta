<template>
    <div class="container">
        <div class="content">
            <div class="content-header">
                <h2>Lista zdjęć psów</h2>
                <router-link
                    class="text-right btn btn-secondary btn-sm"
                    :to="{ name: 'admin.groomerImage.create' }"
                >Dodaj zdjęcia
                </router-link>
            </div>
            <hr>
            <div v-if="error" class="alert alert-danger">
                Wystąpił błąd podczas pobierania zdjęć
            </div>
            <div v-if="groomingImages.length == 0" class="alert alert-primary">
                Brak zdjęć.
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pies</th>
                        <th>Data dodania</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="groomingImage in groomingImages">
                        <td>
                            <b>Rasa: </b>{{ groomingImage.dog_race }},
                            <b>Imię: </b>{{ groomingImage.dog_name }}
                        </td>
                        <td>{{ convertDate(groomingImage.created_at) }}</td>
                        <td class="text-right">
                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm"
                                @click="onDelete(groomingImage.id)"
                            >
                                Usuń
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            groomingImages: {},
            error: false
        }
    },

    mounted() {
        this.fetchGroomingImages();
    },

    methods: {
        fetchGroomingImages() {
            this.error = false;

            axios.get('/json/admin/grooming-image').then((response) => {
                this.groomingImages = _.get(response.data, 'data', {});
            }).catch(_ => {
                this.error = true
                this.$notify({
                    type: 'error',
                    title: 'Błąd',
                    text: 'Wystąpił nieoczekiwany błąd podczas pobierania zdjęć.',
                });
            })
        },

        onDelete(groomingImageId) {
            axios.delete(`/json/admin/grooming-image/${groomingImageId}`)
            .then(_ => {
                this.$notify({
                    type: 'success',
                    title: 'Sukces',
                    text: `Usunięto zdjęcie.`
                })
                this.fetchServices();
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Błąd',
                    text: 'Wystąpił nieoczekiwany błąd podczas usuwania zdjęcia.'
                });
            })
        },
        convertDate(date) {
            return dayjs(date).format('YYYY-MM-DD');
        }
    }
};
</script>