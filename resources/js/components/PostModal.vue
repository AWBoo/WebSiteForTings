<template>

</template>
  
<script>
export default {
  props: {
    post: Object
  },
  methods: {
    closeModal() {
      this.$emit('close');
    }
  }
};
</script>
  
  