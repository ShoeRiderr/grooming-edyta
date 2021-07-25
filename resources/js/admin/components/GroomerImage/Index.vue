<template>
    <div class="container">
        <div class="content">
            <div class="content-header">
                <h2>Lista zdjęć psów</h2>
            </div>
            <hr>
            <div v-if="error" class="alert alert-danger">
                Wystąpił błąd podczas pobierania zdjęć
            </div>
            <div v-if="groomingImages.length == 0" class="alert alert-primary">
                Brak zdjęć.
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Pies</th>
                        <th>Data dodania</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="groomingImage in groomingImages">
                        <td>{{ groomingImage }}</td>
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
        }
    }
};
</script>