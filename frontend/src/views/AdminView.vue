<template>
    <div>
      <p>Hello Admin</p>
    </div>
</template>
<script>
export default {
    name:'AdminView',
    mounted(){
    const type=localStorage.getItem('type');
    if(type=='user')
    {
      this.$router.push({ name: 'login' })
    }
  }
 }

</script>