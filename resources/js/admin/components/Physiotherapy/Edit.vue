<template>
    <text-editor-view
        :loading="loading"
        :is-saved="isSaved"
        @input="onSubmit"
    >
        Edycja wpisu do sekcji fizjoterapia
    </text-editor-view>
</template>

<script>
import TextEditorView from '#/admin/components/_partials/TextEditorView';

export default {
    components: {
        TextEditorView
    },
    data() {
        return {
            loading: false,
            isSaved: false
        }
    },

    methods: {
        onSubmit(values) {
            this.loading = true;

            axios.put(`/json/admin/physiotherapy/${this.$route.params.physiotherapyId}`, {
                title: _.get(values, 'title', ''),
                content: _.get(values, 'content', '')
            })
            .then(_ => {
                this.isSaved = true
                this.$notify({
                    type: 'success',
                    title: 'Sukces',
                    text: 'Pomyślnie dodano nową usługę.'
                });
                this.$router.push({ name: 'admin.physiotherapy.index' });
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
