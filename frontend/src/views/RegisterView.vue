<template>
<div>
    <img class="logo" src="../assets/securealm.png">
    <div class="register">        
        <h1>Register</h1>
        <p>{{ errorMsg }}</p>
        <form  @submit="Submit" method="post">
            <input type="text" placeholder="Enter Name" v-model="form.name" required>
            <input type="email" placeholder="Enter Email" v-model="form.email" required>
            <input type="radio" v-model="form.gender" value="Male">Male
            <input type="radio" v-model="form.gender" value="Female">Female
            <input type="text" placeholder="example A+" v-model="form.blood_type" required>
            <input type="password" placeholder="Enter Password" v-model="form.password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</div>
</template>

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
    margin-bottom:30px;
    margin-right:auto;
    margin-left: auto;
    border: 1px solid skyblue;
 }
.register p{
    color: #FF0000;
    position: relative;
    left: 44%;
}
.register h1{
    color: skyblue;
    position: relative;
    left: 47%;
}
.register button{
    width:320px;
    height:40px;
    background:skyblue;
    padding-left:20px;
    display:block;
    margin-bottom:30px;
    margin-right:auto;
    margin-left: auto;
    color:#fff;
    border: 1px solid skyblue;
    cursor:pointer;
    font-size:20px;
    font-weight:bold;
}
</style>

<script>
import axios from 'axios'
export default {
    name:'registerView',
    data() {
     return {
        form: {
                name:"",
                email:"",
                gender:"",
                blood_type:"",
                password:""
            },
        errorMsg: '',
        }
    },
    methods :{
        Submit(event)
        {
            event.preventDefault()
            axios.post(
            'http://127.0.0.1:8000/api/v1/register',this.form, 
            {
                headers: {"Content-Type": "application/json",}
            })
            .then((response) => {
                console.log(response);
                this.errorMsg = response.data.message;  
            })
            .catch( (error) => {
                console.log(error);
                this.errorMsg = error.response.data.message;
            });
        }
    } 
}
</script>