<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/all-supplier">All Supplier</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Supplier</h1>
                                    </div>
                                    <form @submit.prevent="supplierUpdate" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Full Name" v-model="form.name">
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Email Address"
                                                        v-model="form.email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Address" v-model="form.address">
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Your Shopname"
                                                        v-model="form.shopname">
                                                </div>
                                            </div>
                                        </div>

                            

                                             <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Phone Number" v-model="form.phone_number">
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
                    name: '',
                    email: '',
                    address: '',
                    shopname: '',
                    phone_number: '',
                   


                },
                errors: {}
            }
        },

        created() {
            let id = this.$route.params.id;
            axios.get('/api/supplier/'+id)
            .then(({data}) => {
                this.form = data;
            })
            .catch(error => console.log(error))

 
        },

        methods: {
            supplierUpdate() {  
                let id = this.$route.params.id;
            axios.patch('/api/supplier/'+id,this.form)
            .then(res => {
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Updated'
     });
            this.$router.push({name:'all-supplier'})
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
                        this.form.photo = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }

        }
    }

</script>


<style scoped>

</style>