<template>
<div class="topnav">
  <div class="topnav-centered">
    <a href="#" class="active">Welcome {{user_name}}</a>
  </div>
  <router-link to="/user_profile">Profile</router-link>
  <router-link to="/edit_profile">Edit Profile</router-link>
  <div class="topnav-right">
    <a v-on:click="logout">Logout</a>
  </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'UserHeader',
  data(){
    return{
      user_name:"",
    }
  },
  mounted(){
    this.user_name=localStorage.getItem('user_name');
  },
  methods:{
    logout(){
        const token=localStorage.getItem('token');
        axios.get('http://127.0.0.1:8000/api/v1/user/logout',{
            headers: {'Authorization': 'Bearer ' + token}
        })
        .then((response) => {
          console.log(response)
        localStorage.clear();
        this.$router.push({ name: 'login' })
        })
        .catch((error) => console.log(error.message))
    }
  }
}
</script>

<style>
.topnav {
  position: relative;
  background-color: #333;
  overflow: hidden;
}
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a:hover {
  background-color: #ddd;
  color: black;
}
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
.topnav-centered a {
  float: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.topnav-right {
  float: right;
}

@media screen and (max-width: 600px) {
  .topnav a, .topnav-right {
    float: none;
    display: block;
  }

  .topnav-centered a {
    position: relative;
    top: 0;
    left: 0;
    transform: none;
  }
}
</style>