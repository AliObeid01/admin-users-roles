<template>
<div>
    <p>{{ errorMsg }}</p>
        <form  @submit="Submit" method="post">
        <label for="uname"><b>Email:</b></label>
        <input type="email" placeholder="Enter Email" v-model="form.email" required>
        <br><br>
        <label for="psw"><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" v-model="form.password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
    <br>
</div>
</template>
<script>
import axios from 'axios'
export default {
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
            })
            .catch( (error) => {
                console.log(error);
                this.errorMsg = error.response.data.message;
            });
        }
    } 
}
</script>
