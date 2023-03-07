<template>
<div>
<UserHeader/>
<div class="card">
  <div class="container">
    Name:<h4><b>{{user.name}}</b></h4>
  </div>
  <div class="container">
    Email:<p><b>{{user.email}}</b></p>
  </div>
  <div class="container">
    Gender:<p><b>{{user.gender}}</b></p>
  </div>
  <div class="container">
    Blood Type:<p><b>{{user.blood_type}}</b></p>
  </div>
 <div class="container">
    Certificates:
    <p v-for="item in user_certificates" :key="item.id" ><b>{{item.name}}</b><a href="#" v-on:click="remove(item.id)">remove</a></p>
  </div>
    <p><b>Approved by Admin</b></p>
</div>
<Footer/>
</div>
</template>

<script>
import UserHeader from '../components/UserHeader.vue'
import Footer from '../components/FooterView.vue'
import axios from 'axios'
export default {
    name: 'UserProfile',
    components:{
     UserHeader,
     Footer
    },
    data() {
     return {
      user:[],
      user_certificates:[]
     }
    },
    async mounted(){
    const token=localStorage.getItem('token');
    const type=localStorage.getItem('type');
    if(type=='admin')
    {
      this.$router.push({ name: 'admin' })
    }
    await axios.get('http://127.0.0.1:8000/api/v1/user/user_profile',{
                headers: {'Authorization': 'Bearer ' + token}
            })
        .then((response) => {
         this.user = response.data;
         })
        .catch((error) => console.log(error.response.data))
    await axios.get('http://127.0.0.1:8000/api/v1/user/user_certificates',{
                headers: {'Authorization': 'Bearer ' + token}
            })
        .then((response) => {
         this.user_certificates = response.data;
         console.log(this.user_certificates)
         })
        .catch((error) => console.log(error.response.data))        
    },
    methods:{
        remove(certificate_id){
          const token=localStorage.getItem('token');
          axios.post('http://127.0.0.1:8000/api/v1/user/remove_certificate',
          {
            certificate_id:certificate_id
          },
          {
            headers: {'Authorization': 'Bearer ' + token},
                  
          })
          .then((response) => {
          console.log(response.data);
          })
          .catch((error) => console.log(error.response.data))
      }  
    }    
}
</script>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  margin: auto;
  width: 20%;
  margin-top:30px;
  padding: 10px;
  background-color:#04AA6D;
  text-align:center;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.container {
  text-align:center;
  background-color:white;
}
.container a {
  float:right;
  padding-right:4px;
}

</style>