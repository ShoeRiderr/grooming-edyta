export default {
    methods: {
        getErrors(field) {
            return this.errors !== null && this.errors[field]
                ? this.errors[field]
                : null;
        },
        hasErrors(field) {
            return this.getErrors(field) !== null;
        },
    },
};
