<template>
<div>
<Header/>
  <table border="1">
  <caption style="font-size:30px">Certificates Per Users</caption>
    <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Details</td>
    </tr>
    <tr v-for="cert in certificates.data" :key="cert.id">
      <td>{{cert.id}}</td>
      <td>{{cert.name}}</td>
      <td><button v-on:click="details(cert.id)">View</button></td>
    </tr>
  </table>
  <table border="1">
    <tr>
      <td>Number of Users</td>
      <td id="details"></td>
    </tr>
  </table>
  <Footer/>
</div>
</template>

<script>
import axios from 'axios'
import Header from '../components/HeaderView.vue'
import Footer from '../components/FooterView.vue'
export default {
    name:'ReportsView',
    components:{
      Header,
      Footer
    },
    data() {
     return {
      certificates:[],
     }
    },
    async mounted(){
    const token=localStorage.getItem('token');
    const type=localStorage.getItem('type');
    if(type=='user')
    {
      this.$router.push({ name: 'user_profile' })
    }
    axios.get('http://127.0.0.1:8000/api/v1/admin/certificates',{
            headers: {'Authorization': 'Bearer ' + token}
          })
        .then((response) => {
        this.certificates = response.data;
        console.log(this.certificates);
        })
        .catch((error) => console.log(error.message))
      },
    methods:{
      async details(cert_id){
        const token=localStorage.getItem('token');
         await axios.post('http://127.0.0.1:8000/api/v1/admin/certificates_report',
         {
          id:cert_id
         },
         {
            headers: {'Authorization': 'Bearer ' + token},
                
         })
        .then((response) => {
         console.log(response.data);
         document.getElementById("details").innerHTML=`<td>${response.data}</td>`;
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
  border-color:black;
}
button{
  background-color: #04AA6D;
  border: none;
  border-radius: 7px;
  color: white;
  padding: 5px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>