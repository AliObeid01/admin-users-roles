<template>
<div>
    <Logo/>
    <div class="login">
        <h1>Login</h1>
        <div class="msg">{{ msg }}</div>
        <form  @submit="Submit" method="post">
        <input type="email" placeholder="Enter Email" v-model="form.email" required>
        <input type="password" placeholder="Enter Password" v-model="form.password" required>
        <button type="submit">Login</button>
        </form>
        <h3>
          Dont Have acoount? <router-link to="/register">Register</router-link>
        </h3>
    </div>
</div>
</template>

<style>
 .login input{
    width:300px;
    height:40px;
    padding-left:20px;
    display:block;
    margin-bottom:20px;
    margin-right:auto;
    margin-left: auto;
    border: 1px solid #04AA6D;
 }
.msg{
    color: #FF0000;
    text-align:center;
    padding-bottom:4px;
}
.login h3{
    color: #04AA6D;
    position: relative;
    left: 42%;
}
.login h1{
    color: #04AA6D;
    position: relative;
    left: 47%;
}
.login button{
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

<script>
import Logo from '../components/LogoView.vue'
import axios from 'axios'
export default {
    name:'loginView',
    components:{
     Logo
    },
    data() {
     return {
        form: {
                email:"",
                password:""
            },
        msg: '',
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
                localStorage.setItem('type', response.data.user.type);
                localStorage.setItem('user_name', response.data.user.name);
                const type=localStorage.getItem('type')
                if(type=='admin'){
                  this.$router.push({ name: 'admin' }) 
                }
                else{
                  this.$router.push({ name: 'user_profile' })
                }     
            })
            .catch( (error) => {
                this.msg = error.response.data.message;
            });
        }
    }
}
</script>
