<template>
    <div class="row mb-3">
        <div class="col-11">
            <input id="meta" class="form-control" v-model="meta.name">
        </div>
        <div class="col-1">
            <button type="button" class="btn btn-outline-secondary mx-auto" @click="onDelete">Usuń</button>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        meta: {
            required: true,
            type: Object
        },

        index: {
            required: true,
            type: Number
        }
    },

    methods: {
        onDelete() {
            this.$emit('remove', this.index);
        }
    }
};
</script>