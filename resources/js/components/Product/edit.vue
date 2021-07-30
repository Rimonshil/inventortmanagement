<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/all-product">All Product</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update Product</h1>
                                    </div>
                                   <form @submit.prevent="productUpdate" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                 <label for="exampleInputFirstName"> Product Name</label>

                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Product Name" v-model="form.product_name">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName"> Product category</label>
                                                  <select id="exampleInputFirstName" class="form-control" v-model="form.category_id">
                                                      <option v-for="category in categories" :value="category.id" :key="category.id">{{category.category_name}}</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName"> Product Code</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Product Code" v-model="form.product_code">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail"> Product Root</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Product root"
                                                        v-model="form.root">
                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName">Buying Price</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Buying Price" v-model="form.buying_price">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail">Selling Price</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Selling Price"
                                                        v-model="form.selling_price">
                                                </div>
                                            </div>
                                        </div>


                                              <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName">Product Supplier</label>
                                                  <select id="exampleInputFirstName" class="form-control" v-model="form.supplier_id">
                                                      <option v-for="supplier in suppliers" :value="supplier.id" :key="supplier.id">{{supplier.name}}</option>
                                                  </select>
                                                </div>
                                               

                                                <div class="col-md-6">
                                                     <label for="exampleInputFirstName">Buying Date</label>
                                                    <input type="date" class="form-control" id="exampleInputFirstName"
                                                        aria-describedby="emailHelp" placeholder="Enter Buying Date"
                                                        v-model="form.buying_date">
                                                </div>
                                            </div>
                                        </div>


                                             <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputFirstName">Product Quantity</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Product Quantity" v-model="form.product_quantity">
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
                                            <img :src="form.image" alt="" style="height:40px;width:40px;">
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
                    product_name: null,
                    category_id: null,
                    product_code: null,
                    root: null,
                    buying_price: null,
                    selling_price: null,
                    supplier_id:null,
                    buying_date:null,
                    product_quantity:null,


                },
                errors: {},
                categories:{},
                suppliers:{}
            }
        },

        created() {
            let id = this.$route.params.id;
            axios.get('/api/product/'+id)
            .then(({data}) => {
                this.form = data;
            })
            .catch(error => console.log(error))


             axios.get('/api/category/')
            .then(({data}) => {
                this.categories = data
            })
            .catch()

             axios.get('/api/supplier/')
            .then(({data}) => {
                this.suppliers = data
            })
            .catch()

 
        },

        methods: {
            productUpdate() {  
                let id = this.$route.params.id;
            axios.patch('/api/product/'+id,this.form)
            .then(res => {
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Inserted'
     });
            this.$router.push({name:'all-product'})
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