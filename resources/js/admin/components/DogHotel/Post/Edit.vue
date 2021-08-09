<template>
    <div class="container">
        <div class="content">
            <div class="content-header">
                <h1>Edycja postu do sekcji hotel dla psów</h1>
            </div>

            <post-form
                id="post-form"
                :errors="errors"
                @submit="onSubmit"
            >
            </post-form>

            <div class="form-group mt-2">
                <button form="post-form" type="submit" class="btn btn-primary float-right">Zmień post</button>
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
            });
            data.append('title', _.get(images, 'title') || '');
            data.append('content', _.get(images, 'content') || '');

            axios.put(`/json/admin/dog-hotel/post/${this.$route.params.id}`, data, {
                headers: { 'Content-Type': 'multipart/form-data' },
            }).then((response) => {
                this.$notify({
                    type: 'success',
                    text: 'Dodano post.',
                });

                this.$router.push({ name: 'admin.dogHotel.index' });
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.errors = _.get(error.response.data, 'errors', {});
                } else {
                    this.$notify({
                        type: 'error',
                        title: 'Błąd',
                        text: 'Wystąpił nieoczekiwany błąd podczas dodawania posta.',
                    });
                }
            });
        },
    },
};
</script>
