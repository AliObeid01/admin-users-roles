<template>
    <div>
      <UserHeader/>
    </div>
</template>

<script>
import UserHeader from '../components/UserHeader.vue'
export default {
    name:'UserView',
    components:{
      UserHeader
    },
    mounted(){
    const type=localStorage.getItem('type');
    if(type=='admin')
    {
      this.$router.push({ name: 'admin' })
    }
  }
 }
</script>