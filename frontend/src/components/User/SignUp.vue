<template>
    <div>
   <form @submit.prevent="submitForm">
     <div>
       <label for="username">Username</label>
       <input type="text" id="username" v-model="formValues.username">
     </div>
     <div>
       <label for="email">Email</label>
       <input type="text" id="email" v-model="formValues.email">
     </div>
     <div>
       <label for="password">Password</label>
       <input type="password" id="password" v-model="formValues.password">
     </div>
     <div>
       <button type="submit">Sign Up</button>
     </div>
   </form>
    </div>
 </template>


 <script>
 import axios from 'axios';
 export default{
     name : 'SignUp',
     data() {
     return {
       submitData:[],
       formValues: {
         username : '',
         email:'',
         password :'',
       }
     };
   },
   methods :{
     submitForm(){
       axios.post('http://127.0.0.1:8000/signup',this.formValues)
       .then((response) => alert(response.data.message))
       .catch((error) => console.log(error));
     },
   }
 
 }
 </script>
 