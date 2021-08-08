<template>
    <article>
      <img class="article-img" :src="post.image.file_pathname" alt=" " />
      <h1 class="article-title">
        { post.title }
      </h1>
    </article>
</template>
<script>
export default {
    props: {
        post: {
            required: true,
            type: Object
        }
    }
};
</script>