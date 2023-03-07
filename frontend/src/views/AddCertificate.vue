<template>
<div>
<Header/>
<div class="addCertificate">
    <h1>Add Certificate</h1>
    <p>{{ msg }}</p>
    <form  @submit="Submit" method="post">
    <input type="text" placeholder="Enter Certificate" v-model="form.name" required>
    <button type="submit">Add</button>
    </form>
    </div>
</div>
</template>

<script>
import Header from '../components/HeaderView.vue'
import axios from 'axios'
export default {
    name: 'AddCertificate',
    components:{
     Header
    },
    data() {
     return {
        form: {
            name:"",
        },
            msg: '',
        }
    },
    mounted(){
    const type=localStorage.getItem('type');
    if(type=='user')
    {
      this.$router.push({ name: 'user_profile' })
    }
    },
    methods :{
     Submit(event)
        {
            event.preventDefault()
            const token=localStorage.getItem('token');
            axios.post(
            'http://127.0.0.1:8000/api/v1/admin/add_certificate',this.form, 
            {
                headers: {'Authorization': 'Bearer ' + token,"Content-Type": "application/json"}
            })
            .then((response) => {
                this.msg = response.data.message;
                this.form="";
            })
            .catch( (error) => {
                console.log(error.response.data.message);
            });
        }
    }
}
</script>

<style>
.addCertificate input{
    width:300px;
    height:40px;
    padding-left:20px;
    display:block;
    margin-bottom:20px;
    margin-right:auto;
    margin-left: auto;
    border: 1px solid #04AA6D;
 }
.addCertificate h1{
    color: #04AA6D;
    position: relative;
    left: 43%;
}
.addCertificate p{
    color: #FF0000;
    position: relative;
    left: 43%;
}
.addCertificate button{
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