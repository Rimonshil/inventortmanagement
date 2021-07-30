<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/all-expense">All Expense</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                                    </div>
                                    <form @submit.prevent="ExpenseStore" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="">Expense Details</label>
                                                   <textarea cols="30" rows="5" class="form-control" v-model="form.details"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Expense Amount" v-model="form.amount">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Expense Amount" v-model="form.expense_date">
                                                </div>
                                            </div>
                                        </div>

                          
                                        <div class="form-group">
                                         <div class="col-md-6">

                                            <button type="submit" class="btn btn-primary btn-block">Submit </button>
                                         </div>
                                        </div>
                                        <hr>

                                    </form>
                                    <hr>

                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
    export default {
        created() {
            if(!User.loggedIn()){
            this.$router.push({name:'/'})
            }
        },
        data() {
            return {
                form: {
                    details: null,
                    amount:null,
                    expense_date:null
                 
                },
                errors: {}
            }
        },

        methods:{
            ExpenseStore() {
                axios.post('/api/expense',this.form)
                .then(res => {
                Toast.fire({
                 icon: 'success',
                 title: 'successfully Inserted'
     });
               this.$router.push({name:'all-expense'})
                })
                .catch(error=> this.errors = error.response.data.errors)
            }
           
        }

       
    }

</script>


<style scoped>

</style>