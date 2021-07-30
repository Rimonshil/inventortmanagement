<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/store-customer">Add Customer</router-link>
        </div>
        <br>

        <input type="text" v-model="searchTerm" placeholder="Search Here" class="form-control" style="width:300px;">
        
        
        <br>
         <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr  v-for="customer in filterSearch" :key="customer.id">
                        <td>{{customer.customer_name}}</td>
                        <td><img :src ="customer.customer_photo" id="em_photo"></td>
                        <td>{{customer.customer_email}}</td>
                          <td>{{customer.customer_phone}}</td>

              
                        <td>{{customer.customer_address}}</td>
                        <td>
                          <router-link :to="{name:'edit-customer' , params:{id:customer.id}}" class="btn btn-sm btn-primary"><font color="#ffffff">Edit</font></router-link>
                          <a @click="deleteEmployee(customer.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>

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
                customers:[],
                searchTerm:''
            }
        },

        computed: {
           filterSearch() {
             return this.customers.filter (customer => {
               return customer.customer_name.match(this.searchTerm)
             })
           }
        },

        methods: {
            allEmployee(){
              axios.get('/api/customer/')
              .then(({data}) => (this.customers = data))
              .catch()
            },

            deleteEmployee(id){
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

                axios.delete('/api/customer/' + id)
                .then(() => {
                  this.customers = this.customers.filter(customer => {
                    return customer.id != id
                  })
                })
                .catch(() => {
                  this.$router.push({name:'customer'})
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
          this.allEmployee();
        }
    }

</script>


<style scoped>

#em_photo {
  height: 40px;
  width: 40px;
}

</style>