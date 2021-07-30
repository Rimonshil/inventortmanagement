<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/all-category">All Category</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Category</h1>
                                    </div>
                                    <form @submit.prevent="ExpenseUpdate" enctype="multipart/form-data">

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
                                            <button type="submit" class="btn btn-primary btn-block">Update </button>
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

        created() {
            let id = this.$route.params.id;
            axios.get('/api/expense/'+id)
            .then(({data}) => {
                this.form = data;
            })
            .catch(error => console.log(error))

 
 
        },

        methods: {
            ExpenseUpdate() {  
                 let id = this.$route.params.id;
           axios.patch('/api/expense/'+id,this.form)
           .then(res => {
                          Toast.fire({
                 icon: 'success',
                 title: 'successfully Updated'
     });
     this.$router.push({name:'all-expense'})
           })
           .catch(error => this.errors = error.response.data.errors)
            },


           

        }
    }

</script>


<style scoped>

</style>