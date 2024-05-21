<template>
    <div>
        <form @submit.prevent="submitForm">
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" v-model="formValues.email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" v-model="formValues.password">
            </div>
            <div>
                <button type="submit">Sign In</button>
            </div>
        </form>
    </div>
 </template>


 <script>
 import App from '@/App.vue';
import axios from 'axios';
    export default{
    name : 'SignIn',
        data() {
            return {
                formValues: {
                    email:'',
                    password :'',
                }
            }
        },
        methods :{
            submitForm(){
        
                axios.post('http://127.0.0.1:8000/login',this.formValues)
                .then((response) => {
                    if(response.data.message === "SignIn Successfull!"){
                        this.$router.push('Dashboard');
                        localStorage.setItem('id', response.data.id);
                    }else{
                        alert("Error!");
                    }
                })
                .catch((error) => console.log(error));
            },
        }
    }
 </script>
 