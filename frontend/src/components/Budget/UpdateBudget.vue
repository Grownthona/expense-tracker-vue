<template>
    <div>
        <div class="modal-overlay" v-if="visible" @click="close">
            <div class="modal-container" @click.stop>
                <button class="modal-close" @click="close">X</button>
                <div class="modal-content">
                    <form @submit.prevent="submitForm(id)">
                        <div>
                            <label for="category">Category</label>
                            <select name="category" v-model="formValues.category" >
                                <option v-for="(data,index) in tempcategory" :key="index" :value="data.name">
                                    {{ data.name}}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" v-model="formValues.amount">
                        </div>
                        <div>
                            <button type="submit">Update Budget</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
 import axios from 'axios';
 export default{
     name : 'UpdateBudget',
     created(){
        this.getData();
     },
     data() {
        return{
            formValues: {
                category:'',
                amount :'',
                total :0,
                user_id : ''
            },
            tempcategory :[],
        }
    },
    props: {
        visible: {
            type: Boolean,
            required: true,
        },
        id : {
            type: Number
        }
    },
    methods: {
        getData(){
            //this.formValues.user_id = window.localStorage.getItem('id'); 
            axios.get('http://127.0.0.1:8000/category')
            .then((response) => this.tempcategory=response.data)
            .catch((error) => console.log(error));
        },

        close() {
            this.$emit('close');
        },

        async submitForm(id){
            const userID = window.localStorage.getItem('id');
            this.formValues.user_id = userID;
            try{
                let response = await axios.post(`http://127.0.0.1:8000/updatebudget/${id}`,this.formValues);
                if(response.status === 200){
                    alert(response.data.message);
                    this.$emit('close');
                }else{
                    alert("Data couldn't be updated!");
                }
            }catch (error) {
                console.error('Error fetching budgets:', error);
            }
        },
    },
}
 </script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-container {
  background: white;
  padding: 20px;
  border-radius: 8px;
  position: relative;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 1.2rem;
}
</style>

