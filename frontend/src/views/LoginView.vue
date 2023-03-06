<template>
<div>
    <img class="logo" src="../assets/securealm.png">
    <div class="login">
        <h1>Login</h1>
        <p>{{ errorMsg }}</p>
        <form  @submit="Submit" method="post">
        <input type="email" placeholder="Enter Email" v-model="form.email" required>
        <input type="password" placeholder="Enter Password" v-model="form.password" required>
        <button type="submit">Login</button>
        </form>
    </div>
    <br>
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
 .login input{
    width:300px;
    height:40px;
    padding-left:20px;
    display:block;
    margin-bottom:30px;
    margin-right:auto;
    margin-left: auto;
    border: 1px solid skyblue;
 }
.login p{
    color: #FF0000;
}
.login h1{
    color: skyblue;
    position: relative;
    left: 47%;
}
.login button{
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
import router from '../router'
export default {
    name:'LoginView',
    data() {
     return {
        form: {
                email:"",
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
            'http://127.0.0.1:8000/api/v1/login',this.form, 
            {
                headers: {"Content-Type": "application/json",}
            })
            .then((response) => {
                console.log(response);
                localStorage.setItem('token', response.data.access_token);
                router.push({ name: 'admin' }) 
            })
            .catch( (error) => {
                console.log(error);
                this.errorMsg = error.response.data.message;
            });
        }
    } 
}
</script>
