<template>
    <div>
        <div class="row">
            <router-link class="btn btn-primary" to="/store-supplier">Add Supplier</router-link>
        </div>
        <br>

        <input type="text" v-model="searchTerm" placeholder="Search Here" class="form-control" style="width:300px;">
        
        
        <br>
         <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr  v-for="supplier in filterSearch" :key="supplier.id">
                        <td>{{supplier.name}}</td>
                        <td><img :src ="supplier.photo" id="em_photo"></td>
                        <td>{{supplier.email}}</td>
                       <td>{{supplier.address}}</td>

                          <td>{{supplier.phone_number}}</td>

                        <td>
                          <router-link :to="{name:'edit-supplier' , params:{id:supplier.id}}" class="btn btn-sm btn-primary"><font color="#ffffff">Edit</font></router-link>
                          <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>

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
            return{
                suppliers:[],
                searchTerm:''
            }
        },

        computed:{
            filterSearch() {
            return this.suppliers.filter(supplier => {
                return supplier.phone_number.match(this.searchTerm)
            })
        }
        },

        methods:{
            allsupplier() {
                axios.get('/api/supplier/')
                .then(({data}) => (this.suppliers = data))
                .catch(error =>console.log(error))
            },

            deleteSupplier(id) {
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

               axios.delete('/api/supplier/' + id)
               .then(() => {
                 this.suppliers = this.suppliers.filter(supplier => {
                   return supplier.id != id;
                 })
               })
               .catch(() => {
                this.$router.push({name:'supplier'})

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

        created() {
           this.allsupplier();
        }
    
    }
    
</script>


<style scoped>

#em_photo {
  height: 40px;
  width: 40px;
}

</style>