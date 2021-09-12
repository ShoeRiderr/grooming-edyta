export default {
    methods: {
        imageSrc(image) {
            return window.location.origin + `/storage/${image}`
        },
    }
}