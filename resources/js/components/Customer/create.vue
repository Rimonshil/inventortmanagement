<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/all-customer">All Customer</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Customer</h1>
                                    </div>
                                    <form @submit.prevent="employeeStore" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName">Enter Customer Name</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Full Name" v-model="form.customer_name">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail">Enter Customer Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Email Address"
                                                        v-model="form.customer_email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName">Enter Customer Address</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Address" v-model="form.customer_address">
                                                </div>

                                            </div>
                                        </div>

                       


                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName">Enter Customer Phone</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Phone Number" v-model="form.customer_phone">
                                                </div>
                                            </div>
                                             

                                            <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                        <label for="exampleInputFirstName">Enter Customer Photo</label>
                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                </div>

                                                <div class="col-md-6">
                                            <img :src="form.customer_photo" alt="" style="height:40px;width:40px;">
                                        </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit </button>
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
                    customer_name: null,
                    customer_email: null,
                    customer_address: null,
                    customer_photo:null,
                    customer_phone:null


                },
                errors: {}
            }
        },

        methods: {
            employeeStore() {
            axios.post('/api/customer',this.form)
            .then(res => {
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Inserted'
     });
            this.$router.push({name:'all-customer'})
            })

            .catch(error => this.errors = error.response.data.errors)
            },


            onFileSelected(event) {
              
                let file = event.target.files[0]
                if(file.size > 1048770){
                Toast.fire({
                    icon: 'warning',
                    title: 'Upload image less than 1 MB'
                })      
                }else{
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.customer_photo = event.target.result;
                        console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

        }
    }

</script>


<style scoped>

</style>