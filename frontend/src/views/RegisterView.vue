<template>
<div>
    <form  @submit="Submit" method="post">
        <label for="uname"><b>Name:</b></label>
        <input type="email" placeholder="Enter Name" v-model="form.name" required>
        <br><br>
        <label for="uemail"><b>Email:</b></label>
        <input type="email" placeholder="Enter Email" v-model="form.email" required>
        <br><br>
        <label for="ugender"><b>Gender:</b></label>
        <input type="radio" v-model="form.male" value="Male">Male
        <input type="radio" v-model="form.male" value="Female">Female
        <br><br>
        <label for="ublood"><b>Blood Type:</b></label>
        <select name="bloodtype" id="bt">
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        </select>
        <br><br>
        <label for="psw"><b>Password:</b></label>
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