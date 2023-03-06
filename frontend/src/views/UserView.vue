<template>
    <div>
      <p>Hello User</p>
    </div>
</template>
<script>
export default {
    name:'UserView',
    mounted(){
    const type=localStorage.getItem('type');
    if(type=='admin')
    {
      this.$router.push({ name: 'admin' })
    }
  }
 }
</script>