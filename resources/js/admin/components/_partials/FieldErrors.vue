<template>
  <div>
    <div class="invalid-feedback" v-for="(error, index) in errors" :key="index">
      <span v-html="error"></span>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        errors: {
            required: true,
        },
    },
};
</script>

<style scoped>
.form-control.is-invalid ~ div > .invalid-feedback {
  display: block;
}
div.is-invalid > .invalid-feedback {
  display: block;
}
</style>
