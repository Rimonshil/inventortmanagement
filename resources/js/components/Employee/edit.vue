<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/all-employee">All Employee</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update Employee</h1>
                                    </div>
                                    <form @submit.prevent="employeeUpdate" enctype="multipart/form-data">


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
                                                        aria-describedby="emailHelp" placeholder="Enter Your Sallary"
                                                        v-model="form.sallary">
                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="Date" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Joining Date" v-model="form.joining_date">
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Your NID"
                                                        v-model="form.nid">
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

                                            <!-- <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                </div>

                                                <div class="col-md-6">
                                            <img :src="form.photo" alt="" style="height:40px;width:40px;">
                                        </div>
                                            </div>
                                        </div> -->
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
                    sallary: '',
                    joining_date: '',
                    nid: '',
                 
                    phone_number:''


                },
                errors: {}
            }
        },

        created() {
            let id = this.$route.params.id;
            axios.get('/api/employee/'+id)
            .then(({data}) => {
                this.form = data;
            })
            .catch(error => console.log(error))

 
        },

        methods: {
            employeeUpdate() {  
                let id = this.$route.params.id;
            axios.patch('/api/employee/'+id,this.form)
            .then(res => {
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Inserted'
     });
            this.$router.push({name:'all-employee'})
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