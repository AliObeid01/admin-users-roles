<template>
<router-view/>
</template>
<script>
export default {
    name:'App',
  }
  const token=localStorage.getItem('token');
  console.log(token);
</script>