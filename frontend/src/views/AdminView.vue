<template>
<div>
  <table border="1">
    <tr>
      <td>Name</td>
      <td>Email</td>
      <td>Gender</td>
      <td>Blood Type</td>
      <td>Last Login</td>
      <td>Status</td>
    </tr>
    <tr v-for="user in users.data" :key="user.id">
      <td>{{user.name}}</td>
      <td>{{user.email}}</td>
      <td>{{user.gender}}</td>
      <td>{{user.blood_type}}</td>
      <td>{{user.last_login}}</td>
      <td v-if="user.status===0"><button>Approve</button></td>
      <td v-else>Approved</td>
    </tr>
  </table>
</div>
</template>

<script>
import axios from 'axios'
export default {
    name:'AdminView',
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
    } 
}
</script>

<style>
 td {
width:100px;
text-align:center;
}
table{
  margin-left: auto; 
  margin-right: auto;
  border-color:skyblue;
}
</style>