<template>
<router-view></router-view>
</template>
<script>
export default {
    name:'App',
    mounted(){
      const token=localStorage.getItem('token');
      if(!token)
      {
        this.$router.push({ name: 'login' })
      }
    }
  }
</script>