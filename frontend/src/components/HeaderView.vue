<template>
<div class="topnav">
  <div class="topnav-centered">
    <a href="#" class="active">Admin Panel</a>
  </div>
  <router-link to="/admin">Users</router-link>
  <router-link to="/add_certificate">Add Certificate</router-link>
  <router-link to="/reports">Reports</router-link>
  <div class="topnav-right">
    <a v-on:click="logout">Logout</a>
  </div>
</div>
</template>

<script>
export default {
  name: 'HeaderView',
  methods:{
    logout(){
        localStorage.clear();
        this.$router.push({ name: 'login' })
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