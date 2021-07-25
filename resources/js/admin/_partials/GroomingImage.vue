<template>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <span>{{ iteration }}. {{ file.name }}</span>

            <button type="button" class="ml-auto btn btn-sm btn-outline-secondary" @click="onRemoveClick">Usuń</button>
        </div>

        <div class="card-body">
            <div class="row">
                <grooming-image-preview
                    class="col-xl-6 d-flex align-items-center justify-content-center"
                    :file="file.source"
                    :file-name="file.source.name"
                    :file-extension="file.extension"
                />

                <div class="col-xl-6">

                    <div class="form-group">
                        <label :for="`name-${iteration}`">Nazwa pliku</label>

                        <input
                            :id="`name-${iteration}`"
                            type="text"
                            class="form-control"
                            required
                            v-model="file.name"
                        />
                    </div>

                    <div class="form-group">
                        <label :for="`description-${iteration}`">Opis</label>

                        <textarea
                            :id="`description-${iteration}`"
                            class="form-control"
                            rows="3"
                            v-model="file.description"
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import GroomingImagePreview from './GroomingImagePreview';

export default {
    components: {
        GroomingImagePreview,
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
