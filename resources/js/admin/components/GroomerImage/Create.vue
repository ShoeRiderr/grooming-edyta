<template>
    <div class="container">
        <div class="content">
            <div class="content-header">
                <h1>Dodaj zdjęcia psów</h1>
            </div>
            <image-form
                id="grooming-image-form"
                :errors="errors"
                @submit="onSubmit"
            >
                <div class="form-group">
                    <label for="dog_race">Rasa psa</label>
                    <input type="text" id="dog_race" required class="form-control" v-model="groomingImageData.dog_race">

                    <field-errors
                        :class="[{ 'is-invalid': hasErrors(`dog_race`) }]"
                        :errors="getErrors(`dog_race`)"
                    ></field-errors>
                </div>

                <div class="form-group">
                    <label for="dog_name">Imię psa</label>
                    <input type="text" id="dog_name" class="form-control" v-model="groomingImageData.dog_name">

                    <field-errors
                        :class="[{ 'is-invalid': hasErrors(`dog_name`) }]"
                        :errors="getErrors(`dog_name`)"
                    ></field-errors>
                </div>
            </image-form>
            <div class="content-footer">
                <div class="footer-actions">
                    <button form="grooming-image-form" type="submit" class="btn btn-primary">Dodaj zdjęcia</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import validateErrors from '#/admin/mixins/validateErrors.js';
import ImageForm from '#/admin/components/_partials/ImageForm.vue';

export default {
    mixins: [validateErrors],

    components: {
        ImageForm,
    },

    data: function() {
        return {
            errors: {},
            groomingImageData: {}
        };
    },

    methods: {
        onSubmit(images) {
            const data = new FormData();

            images.forEach((image, index) => {
                data.append(`image[${index}][file]`, _.get(image, 'source'));
                data.append(`image[${index}][name]`, _.get(image, 'name'));
                data.append(`image[${index}][description]`, _.get(image, 'description') || '');
                data.append('dog_name', _.get(this.groomingImageData, 'dog_name') || '');
                data.append('dog_race', _.get(this.groomingImageData, 'dog_race') || '');
            });

            axios.post(`/json/admin/grooming-image`, data, {
                headers: { 'Content-Type': 'multipart/form-data' },
            }).then((response) => {
                this.$notify({
                    type: 'success',
                    text: 'Dodano skany.',
                });

                this.$router.push({ name: 'admin.groomerImage.index' });
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
