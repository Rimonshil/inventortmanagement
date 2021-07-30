<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/store-product">Add Product</router-link>
        </div>
        <br>

        <input type="text" v-model="searchTerm" placeholder="Search Here" class="form-control" style="width:300px;">
        
        
        <br>
         <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Buying Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr  v-for="product in filterSearch" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td><img :src ="product.image" id="em_photo"></td>
                        <td>{{product.product_code}}</td>
                          <td>{{product.category_name}}</td>

                        <td>{{product.buying_price}}</td>
                        <td>{{product.selling_price}}</td>
                        <td>{{product.buying_date}}</td>

                        <td>
                          <router-link :to="{name:'edit-product' , params:{id:product.id}}" class="btn btn-sm btn-primary"><font color="#ffffff">Edit</font></router-link>
                          <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>

                          </td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
                products:[],
                searchTerm:''
            }
        },

        computed: {
           filterSearch() {
             return this.products.filter (product => {
               return product.product_name.match(this.searchTerm)
             })
           }
        },

        methods: {
            allProduct(){
              axios.get('/api/product/')
              .then(({data}) => (this.products = data))
              .catch()
            },

            deleteProduct(id){
              Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {

                axios.delete('/api/product/' + id)
                .then(() => {
                  this.products = this.products.filter(product => {
                    return product.id != id
                  })
                })
                .catch(() => {
                  this.$router.push({name:'all-product'})
                })


                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })
            }




        },
        created () {
          this.allProduct();
        }
    }

</script>


<style scoped>

#em_photo {
  height: 40px;
  width: 40px;
}

</style>