<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Edycja postu do sekcji fizjoterapia</h1>
            </div>

            <div class="card-body">
                <post-form
                    id="post-form"
                    :errors="errors"
                    @submit="onSubmit"
                >
                </post-form>
            </div>

            <div class="card-footer">
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
            const metas = _.get(images, 'metas');

            images.forEach((image, index) => {
                data.append(`image[${index}][file]`, _.get(image, 'source'));
                data.append(`image[${index}][title]`, _.get(image, 'title'));
                data.append(`image[${index}][name]`, _.get(image, 'name'));
                data.append(`image[${index}][description]`, _.get(image, 'description') || '');
            });
            data.append('title', _.get(images, 'title') || '');
            data.append('date', _.get(images, 'date') || '');
            data.append('time', _.get(images, 'time') || '');
            data.append('content', _.get(images, 'content') || '');
            data.append('description', _.get(images, 'description') || '');
            metas.forEach((meta, index) => {
                if (_.has(meta, 'id')) {
                    data.append(`metas[${index}][id]`, _.get(meta, 'id'));
                }
                data.append(`metas[${index}][name]`, _.get(meta, 'name'));
            });

            data.append('_method', 'PUT')

            axios.post(`/json/admin/physiotherapy/post/${this.$route.params.id}`, data, {
                headers: { 'Content-Type': 'multipart/form-data' },
            }).then((response) => {
                this.$notify({
                    type: 'success',
                    text: 'Dodano post.',
                });

                this.$router.push({ name: 'admin.news.index' });
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
