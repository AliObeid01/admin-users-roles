<template>
<div class="container">
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
     <div class="panel-heading">List of users
     </div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Status</th>
              <th>Blood Type</th>
              <th>Last Login</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users.data" :key="user.id">
              <td>{{user.name}}</td>
              <td>{{user.email}}</td>
              <td>{{user.gender}}</td>
              <td>{{user.status}}</td>
              <td>{{user.blood_type}}</td>
              <td>{{user.last_login}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
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