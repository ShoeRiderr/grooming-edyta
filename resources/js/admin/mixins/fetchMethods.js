export default {
    data() {
        return {
            values: {
                title: '',
                content: '',
                description: '',
                metas: [],
            },
        }
    },

    methods: {
        fetchAboutCompany() {
            axios.get('/json/admin/about-company')
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchContact() {
            axios.get('/json/admin/contact')
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchDogHotel() {
            axios.get(`/json/admin/dog-hotel`)
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchGrooming() {
            axios.get(`/json/admin/grooming`)
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchPhysiotherapy() {
            axios.get(`/json/admin/physiotherapy`)
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchHandling() {
            axios.get(`/json/admin/handling`)
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },
    }
}
