<template>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <span>{{ iteration }}. {{ file.name }}</span>

            <button type="button" class="ml-auto btn btn-sm btn-outline-secondary" @click="onRemoveClick">Usuń</button>
        </div>

        <div class="card-body">
            <div class="row">
                <image-preview
                    class="col-xl-6 d-flex align-items-center justify-content-center"
                    :file="file.source"
                    :file-name="file.source.name"
                    :file-extension="file.extension"
                />

                <div class="col-xl-6">
                    <div v-if="hasErrors(`image.${index}.file`)" class="alert alert-danger">
                        <ul class="list-unstyled mb-0">
                            <li v-for="error in getErrors(`image.${index}.file`)" v-html="error"></li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label :for="`name-${iteration}`">Nazwa pliku</label>

                        <input
                            :id="`name-${iteration}`"
                            type="text"
                            class="form-control"
                            required
                            v-model="file.name"
                        />

                        <field-errors
                            :class="[{ 'is-invalid': hasErrors(`image.${index}.name`) }]"
                            :errors="getErrors(`image.${index}.name`)"
                        ></field-errors>
                    </div>

                    <div class="form-group">
                        <label :for="`title-${iteration}`">Tytuł</label>

                        <input
                            :id="`title-${iteration}`"
                            type="text"
                            class="form-control"
                            v-model="file.title"
                        />

                        <field-errors
                            :class="[{ 'is-invalid': hasErrors(`image.${index}.title`) }]"
                            :errors="getErrors(`image.title`)"
                        ></field-errors>
                    </div>

                    <div class="form-group">
                        <label :for="`description-${iteration}`">Opis</label>

                        <textarea
                            :id="`description-${iteration}`"
                            class="form-control"
                            rows="3"
                            :class="[{ 'is-invalid': hasErrors(`image.${index}.description`) }]"
                            v-model="file.description"
                        ></textarea>

                        <field-errors
                            :class="[{ 'is-invalid': hasErrors(`image.${index}.description`) }]"
                            :errors="getErrors(`image.${index}.description`)"
                        ></field-errors>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import validateErrors from '#/admin/mixins/validateErrors';
import ImagePreview from './ImagePreview';

export default {
    mixins: [validateErrors],

    components: {
        ImagePreview,
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
