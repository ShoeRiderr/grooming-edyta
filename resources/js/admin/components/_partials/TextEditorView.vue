<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2><slot></slot></h2>
            </div>
            <div class="card-body">
                <text-editor-form
                    :loading="loading"
                    :is-saved="isSaved"
                    @input="onSubmit"
                    class="p-4">
                </text-editor-form>
            </div>
        </div>
    </div>
</template>

<script>
import TextEditorForm from './TextEditorForm';

export default {
    props: {
        loading: {
            default: false
        },
        isSaved: {
            default: false
        },
    },

    components: {
        TextEditorForm
    },

    methods: {
        onSubmit(value) {
            this.$emit('input', value) ;
        },
    }
}
</script>
