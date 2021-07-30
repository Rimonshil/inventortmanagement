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
                                    <form @submit.prevent="CategoryUpdate" enctype="multipart/form-data">

                                         <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Full Name" v-model="form.category_name">
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
                    category_name: '',
                },
                errors: {}
            }
        },

        created() {
            let id = this.$route.params.id;
            axios.get('/api/category/'+id)
            .then(({data}) => {
                this.form = data;
            })
            .catch(error => console.log(error))

 
 
        },

        methods: {
            CategoryUpdate() {  
                 let id = this.$route.params.id;
           axios.patch('/api/category/'+id,this.form)
           .then(res => {
                          Toast.fire({
                 icon: 'success',
                 title: 'successfully Updated'
     });
     this.$router.push({name:'all-category'})
           })
           .catch(error => this.errors = error.response.data.errors)
            },


           

        }
    }

</script>


<style scoped>

</style>