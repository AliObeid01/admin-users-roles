<template>
<div>
    <form  @submit="Submit" method="post">
    <label for="uname"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" v-model="form.email" required>
    <br><br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" v-model="form.password" required>
    <br><br>
    <button type="submit">Register</button>
    </form>
    <br>
</div>
</template>
<script>
export default {
    data() {
    return {
      form: {
            email:"",
            password:""
        }
      }
    },
    methods :{
        Submit(event){
            event.preventDefault()
            alert('done')
        }
    }
    
}
</script>