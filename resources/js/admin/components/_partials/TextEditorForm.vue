<template>
    <div class="card" id="editorContainer">
        <form @submit.prevent="onSubmit">
            <div class="form-group" v-if="withTitle">
                <label for="service_name">Tytuł</label>
                <input type="text" class="form-control" v-model="values.title">
                <hr>
            </div>
            <vue-editor v-model="values.content"></vue-editor>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block" :disabled="loading">Zapisz</button>
            </div>
        </form>
    </div>
</template>

<script>
import fetchMethods from '#/admin/mixins/fetchMethods';
import { VueEditor } from "vue2-editor";

export default {
    mixins: [fetchMethods],

    components: {
        VueEditor
    },

    props: {
        loading: {
            default: false
        },
        isSaved: {
            default: false
        },
    },

    data() {
        return {
            withTitle: false
        }
    },

    mounted() {
        if (this.$route.name == 'admin.physiotherapy.edit' || this.$route.name == 'admin.physiotherapy.create') {
            this.withTitle = true;
            if (this.$route.name == 'admin.physiotherapy.edit') {
                this.fetchPhysiotherapy();
            }
        }
    },

    computed: {
        resetValues() {
            if (this.isSaved) {
                this.values.name = '';
                this.values.content = '';
            }
        },
    },

    methods: {
        onSubmit() {
            this.$emit('input', this.values);
        }
    }
};
</script>
