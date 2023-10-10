<template>
  <a :href="link">
    <div class="btn btn-primary">
      <slot name="content"></slot>
    </div>
  </a>
</template>

<script>
  export default {
    props: ['link'],
  }
</script>
