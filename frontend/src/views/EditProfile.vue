<template>
<div>
<UserHeader/>
<div class="register">        
    <p>{{ errorMsg }}</p>
    <form @submit="Submit" method="post">
        <input type="text" placeholder="Enter Name" v-model="form.name" required>
        <input type="email" placeholder="Enter Email" v-model="form.email" required>
        <input type="text" placeholder="Enter Gender (Male/Female)" v-model="form.gender" required>
        <input type="text" placeholder="Enter Blood Type(ex:A+)" v-model="form.blood_type" required>
        <input type="password" placeholder="Enter New Password" v-model="form.password" required>
        <button type="submit">Save</button>
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
        errorMsg: '',
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
                this.errorMsg = response.data.message;
                this.form="";
            })
            .catch( (error) => {
                console.log(error);
                this.errorMsg = error.response.data.message;
            });
        }
    }        
}
</script>

<style>
 .logo{
   width:300px;
   height:100px;
   display:block;
   margin-bottom:30px;
   margin-right:auto;
   margin-left: auto;
 }
 .register input{
    width:300px;
    height:40px;
    padding-left:20px;
    display:block;
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