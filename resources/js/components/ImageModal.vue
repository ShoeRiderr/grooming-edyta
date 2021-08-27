<template>
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
    </div>
  </div>
</div>
</template>

<script>
import $ from 'jquery'
    export default {

        mounted() {
            console.log('Component mounted.')
        }
    };
</script>
