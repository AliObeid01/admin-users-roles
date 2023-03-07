<template>
<div>
<UserHeader/>
<div class="register">        
    <div class="msg">{{ msg }}</div>
    <form @submit="Submit" method="post">
        <input type="text" placeholder="Enter Name" v-model="form.name" required>
        <input type="email" placeholder="Enter Email" v-model="form.email" required>
        <input type="text" placeholder="Enter Gender (Male/Female)" v-model="form.gender" required>
        <input type="text" placeholder="Enter Blood Type(ex:A+)" v-model="form.blood_type" required>
        <button type="submit">Update Profile</button>
    </form>
</div>
<div class="register">
    <form @submit="Add" method="post">
        <select v-model="select.certificate_id">
         <option v-for="cert in certificates.data" v-bind:key="cert.id" v-bind:value="cert.id">{{ cert.name }}</option>
        </select>
    <button type="submit">Add Certificate</button>
    </form>
</div>
</div>
</template>

<script>
import UserHeader from '../components/UserHeader.vue'
import axios from 'axios'
export default {
    name: 'EditProfile',
    components:{
     UserHeader
    },
    data() {
     return {
        form: {
                name:"",
                email:"",
                gender:"",
                blood_type:"",
            },
        select:{
            certificate_id:''
            },
        msg: '',
        certificates:[],
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
         this.form = response.data;
         console.log(this.form)
         })
        .catch((error) => console.log(error.response.data)) 
    axios.get('http://127.0.0.1:8000/api/v1/user/certificates',{
            headers: {'Authorization': 'Bearer ' + token}
          })
        .then((response) => {
        this.certificates = response.data;
        console.log(this.certificates);
        })
        .catch((error) => console.log(error.message))               
    },
    methods :{
        Submit(event)
        {
            const token=localStorage.getItem('token');
            event.preventDefault()
            axios.post(
            'http://127.0.0.1:8000/api/v1/user/update_profile',this.form, 
            {
                headers: {'Authorization': 'Bearer ' + token,"Content-Type": "application/json",}
            })
            .then((response) => {
                console.log(response);
                this.msg = response.data.message;
                this.form="";
            })
            .catch( (error) => {
                console.log(error);
                this.errorMsg = error.response.data.message;
            });
        },
      Add(event)
        {
            event.preventDefault()
            const token=localStorage.getItem('token');
            console.log(this.select);
            axios.post(
            'http://127.0.0.1:8000/api/v1/user/attach_certificate',this.select, 
            {
                headers: {'Authorization': 'Bearer ' + token}
            })
            .then((response) => {
                this.msg = response.data.message;
            })
            .catch( (error) => {
                console.log(error.response.data.message);
            });
        }
    }        
}
</script>

<style>
.msg{
    color: #FF0000;
    text-align:center;
    padding-bottom:4px;
}
 .register input,select{
    width:300px;
    height:40px;
    padding-left:20px;
    display:block;
    margin-bottom:20px;
    margin-bottom:20px;
    margin-right:auto;
    margin-left: auto;
    border: 1px solid #04AA6D;
 }
.register p{
    color: #FF0000;
    position: relative;
    left: 47%;
}
.register h1{
    color: #04AA6D;
    position: relative;
    left: 46%;
}
.register h3{
    color: #04AA6D;
    position: relative;
    left: 45%;
}
.register button{
    width:320px;
    height:40px;
    background:#04AA6D;
    padding-left:20px;
    display:block;
    margin-bottom:30px;
    margin-right:auto;
    margin-left: auto;
    color:#fff;
    border: 1px solid #04AA6D;
    cursor:pointer;
    font-size:20px;
    font-weight:bold;
}

</style>