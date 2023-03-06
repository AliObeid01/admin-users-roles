<template>
<div>
<Header/>
  <table border="1">
    <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Email</td>
      <td>Gender</td>
      <td>Blood Type</td>
      <td>Last Login</td>
      <td>Status</td>
    </tr>
    <tr v-for="user in users.data" :key="user.id">
      <td>{{user.id}}</td>
      <td>{{user.name}}</td>
      <td>{{user.email}}</td>
      <td>{{user.gender}}</td>
      <td>{{user.blood_type}}</td>
      <td>{{user.last_login}}</td>
      <td v-if="user.status===0"><button v-on:click="approve(user.id)">Approve</button></td>
      <td v-else>Approved</td>
    </tr>
  </table>
</div>
</template>

<script>
import axios from 'axios'
import Header from '../components/HeaderView.vue'
export default {
    name:'AdminView',
    components:{
      Header
    },
    data() {
     return {
      users:[],
     }
    },
    async mounted(){
    const token=localStorage.getItem('token');
    const type=localStorage.getItem('type');
    if(type=='user')
    {
      this.$router.push({ name: 'user' })
    }
    await axios.get('http://127.0.0.1:8000/api/v1/admin/users',{
                headers: {'Authorization': 'Bearer ' + token}
            })
        .then((response) => {
         this.users = response.data;
         console.log(this.users);
         })
        .catch((error) => console.log(error.message))
    },
    methods:{
      
       async approve(user_id){
        const token=localStorage.getItem('token');
         await axios.post('http://127.0.0.1:8000/api/v1/admin/approve_user',
         {
          id:user_id
         },
         {
                headers: {'Authorization': 'Bearer ' + token},
                
         })
        .then((response) => {
         console.log(response.data);
         window.location.reload();
         })
        .catch((error) => console.log(error.response.data))
      }
    }
}
</script>

<style>
body{
  padding: 0;
  margin:0;
}
td {
  width:100px;
  text-align:center;
}
table{
  margin-left: auto; 
  margin-right: auto;
  margin-top:30px;
  border-color:#04AA6D;
}
button{

}
</style>