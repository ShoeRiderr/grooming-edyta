<template>
    <div class="container">
        <div class="content">
            <div class="content-header">
                <h1>Dodaj skany związane z pobytem w szpitalu</h1>
            </div>
            <grooming-image-form
                id="grooming-image-form"
                :errors="errors"
                @submit="onSubmit"
            ></grooming-image-form>
            <div class="content-footer">
                <div class="footer-actions">
                    <button form="grooming-image-form" type="submit" class="btn btn-primary">Dodaj zdjęcia</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import GroomingImageForm from './../../_partials/GroomingImageForm.vue';

export default {
    components: {
        GroomingImageForm,
    },

    data: function() {
        return {
            errors: {},
        };
    },

    methods: {
        onSubmit(images) {
            const data = new FormData();

            images.forEach((image, index) => {
                data.append(`image[${index}][file]`, _.get(image, 'source'));
                data.append(`image[${index}][name]`, _.get(image, 'name'));
                data.append(`image[${index}][description]`, _.get(image, 'description') || '');
            });

            axios.post(`/json/admin/grooming-image`, data, {
                headers: { 'Content-Type': 'multipart/form-data' },
            }).then((response) => {
                this.$notify({
                    type: 'success',
                    text: 'Dodano skany.',
                });

                // this.$router.push({ name: 'admin.index' });
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.errors = _.get(error.response.data, 'errors', {});
                } else {
                    this.$notify({
                        type: 'error',
                        title: 'Błąd',
                        text: 'Wystąpił nieoczekiwany błąd podczas dodawania zdjęć.',
                    });
                }
            });
        },
    },
};
</script>
