<template>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <span>{{ iteration }}. {{ file.name }}</span>

            <button type="button" class="ml-auto btn btn-sm btn-outline-secondary" @click="onRemoveClick">Usuń</button>
        </div>

        <div class="card-body">
            <div class="row">
                <document-scan-preview
                    class="col-xl-6 d-flex align-items-center justify-content-center"
                    :file="file.source"
                    :file-name="file.source.name"
                    :file-extension="file.extension"
                />

                <div class="col-xl-6">
                    <div v-if="hasErrors(`document-scan.${index}.file`)" class="alert alert-danger">
                        <ul class="list-unstyled mb-0">
                            <li v-for="error in getErrors(`document-scan.${index}.file`)" v-html="error"></li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label :for="`name-${iteration}`">Nazwa pliku</label>

                        <input
                            :id="`name-${iteration}`"
                            type="text"
                            class="form-control"
                            :class="[{ 'is-invalid': hasErrors(`document-scan.${index}.name`) }]"
                            required
                            v-model="file.name"
                        />

                        <field-errors
                            :class="[{ 'is-invalid': hasErrors(`document-scan.${index}.name`) }]"
                            :errors="getErrors(`document-scan.${index}.name`)"
                        ></field-errors>
                    </div>

                    <div class="form-group">
                        <label :for="`type-${iteration}`">Typ</label>

                        <select
                            :id="`type-${iteration}`"
                            class="form-control"
                            :class="[{ 'is-invalid': hasErrors(`document-scan.${index}.type`) }]"
                            required
                            v-model="file.type"
                        >
                            <option :value="null" class="d-none" disabled>-</option>
                            <option v-for="documentScanType in documentScanTypes" :value="documentScanType.value">
                                {{ documentScanType.description }}
                            </option>
                        </select>

                        <field-errors
                            :class="[{ 'is-invalid': hasErrors(`document-scan.${index}.type`) }]"
                            :errors="getErrors(`document-scan.${index}.type`)"
                        ></field-errors>
                    </div>

                    <div class="form-group">
                        <label :for="`description-${iteration}`">Opis</label>

                        <textarea
                            :id="`description-${iteration}`"
                            class="form-control"
                            :class="[{ 'is-invalid': hasErrors(`document-scan.${index}.description`) }]"
                            rows="3"
                            v-model="file.description"
                        ></textarea>

                        <field-errors
                            :class="[{ 'is-invalid': hasErrors(`document-scan.${index}.description`) }]"
                            :errors="getErrors(`document-scan.${index}.description`)"
                        ></field-errors>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import validationErrors from '#/documentation/mixins/validationErrors';

import DocumentScanPreview from '@documentation/_partials/DocumentScanPreview.vue';

export default {
    mixins: [
        validationErrors,
    ],

    components: {
        DocumentScanPreview,
    },

    props: {
        index: {
            required: true,
            type: Number,
        },

        file: {
            required: true,
            type: Object,
        },

        documentScanTypes: {
            required: true,
            type: Array,
        },

        errors: {
            required: true,
            type: Object,
        },
    },

    computed: {
        iteration() {
            return this.index + 1;
        },
    },

    methods: {
        onRemoveClick() {
            this.$emit('remove', this.index);
        },
    },
};
</script>
