<template>
    <text-editor-view
        :loading="loading"
        :errors="errors"
        :is-saved="isSaved"
        @input="onSubmit"
    >
        Edycja wpisu do sekcji hotel dla psów
    </text-editor-view>
</template>

<script>
import TextEditorView from '#/admin/components/_partials/TextEditorView';
import contentTypeMethods from '#/admin/mixins/contentTypeMethods.js'

export default {
    mixins: [contentTypeMethods],

    components: {
        TextEditorView
    },
    data() {
        return {
            loading: false,
            isSaved: false,
            errors: {}
        }
    },

    methods: {
        onSubmit(values) {
            this.loading = true;

            axios.post(`/json/admin/dog-hotel/update`, {
                _method: "PUT",
                title: _.get(values, 'title', ''),
                content: _.get(values, 'content', ''),
                description: _.get(values, 'description', ''),
                metas: _.get(values, 'metas', []),
            })
            .then(_ => {
                this.isSaved = true
                this.$notify({
                    type: 'success',
                    title: 'Sukces',
                    text: 'Pomyślnie dodano nową usługę.'
                });
                this.$router.push({ name: 'admin.dogHotel.index' });
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
                this.isSaved = false
            })
        },
    }
};
</script>
