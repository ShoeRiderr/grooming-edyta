<template>
    <div class="container">
        <div class="content">
            <div class="content-header">
                <h1>Dodaj zdjęcia psów</h1>
            </div>

            <post-form
                id="post-form"
                :errors="errors"
                @submit="onSubmit"
            />

            <div class="form-group mt-2">
                <button form="post-form" type="submit" class="btn btn-primary float-right">Dodaj zdjęcia</button>
            </div>
        </div>
    </div>
</template>
<script>
import validateErrors from '#/admin/mixins/validateErrors.js';
import PostForm from '@admin/components/_partials/PostForm';
export default {
    mixins: [validateErrors],

    components: {
        PostForm
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
                data.append('title', _.get(this.post, 'title') || '');
                data.append('content', _.get(this.post, 'content') || '');
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
