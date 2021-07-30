<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>

          <div class="row mb-3">
            
          
         
         

            <!-- Area Chart -->
                  <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
         <a class="btn btn-sm btn-info"><font color="#ffffff">Add Customer</font></a>         
                  
                </div>
                


 
                
                <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for=" cart in cartproducts" :key="cart.id">
                        <td>{{cart.pro_name}}</td>
                        <td><input type="text" readonly="" :value="cart.pro_qty" style="width:15px;">
                        <button class="btn btn-sm btn-success" @click.prevent="increment(cart.id)">+</button>
                        <button class="btn btn-sm btn-danger" @click.prevent="decrement(cart.id)">-</button>

                        </td>
                        <td>{{cart.pro_price}}</td>
                        <td>{{cart.subtotal}}</td>
                        <td><button class="btn btn-sm btn-primary" @click="removeItem(cart.id)">X</button></td>
                      </tr>
                  
                   
                       
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
            <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>{{qty()}}</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong>{{subTotal()}} $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>{{vats.vat}} %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong>{{subTotal() * vats.vat /100 + subTotal() }} $</strong>
   </li> 
              
            </ul>   
            <br> 

        <form @submit.prevent="orderDone"> 
          <label>Customer Name</label>
          <select class="form-control" v-model="customer_id">
                 <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.customer_name}}</option>
           </select>

           <label>Pay</label>
           <input type="text" class="form-control" required="" v-model="pay">

           <label>Due</label>
           <input type="text" class="form-control" required="" v-model="due">

          <label>Pay By</label>
          <select class="form-control" v-model="payby">
                 <option value="HandCash">Hand Cash </option>
                 <option value="Cheaque">Cheaque </option>
                 <option value="GiftCard">Gift Card </option>
           </select>

           <br>
           <button type="submit" class="btn btn-success">Submit</button>

        </form>    



                </div>
             






              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                </div>


                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All product</a>
                    </li>
                    <li class="nav-item" v-for="category in categories" :key="category.id">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)">{{category.category_name}}</a>
                    </li>
                 
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- all product -->
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                             <div class="card-body">
                <input type="text" v-model="searchTerm" placeholder="Search Product" class="form-control" style="width:560px;margin-bottom:5px">

                    <div class="row">

                 <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
                     <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                         <div class="card" style="width: 8.5rem;margin-bottom:5px;">
                        <img class="card-img-top" :src ="product.image" id="em_photo" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="card-title">{{product.product_name}}</h6>
                            <span class="badge badge-success" v-if="product.product_quantity >= 1">Available {{product.product_quantity}}</span>
                            <span class="badge badge-danger" v-else>stock out</span>
                       
                        </div>
                        </div>
                        </button>
                     </div>
                 </div>
                </div>
                    </div>
                    <!-- end All product -->

                   <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


<input type="text" v-model="getsearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
            
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img :src="getproduct.image" id="em_photo" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title">{{ getproduct.product_name }}</h6>
       <span class="badge badge-success" v-if="getproduct.product_quantity  >= 1 ">Available {{ getproduct.product_quantity }}  </span> 
                
              </div>
            </div>
          
        </div>        
      </div>




  </div>

                    </div>


















            
               
              </div>
            </div>
          
          </div>
          <!--Row-->


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

          created () {
          this.allProduct();
          this.allCategoty();
          this.allCustomer();
          this.cartProduct();
          this.vat();
          Reload.$on('Afteradd', () => { 
           this.cartProduct();
           })


        },
        data() {
            return {
                customer_id:'',
                pay:'',
                due:'',
                payby:'',
                products:[],
                categories:[],
                searchTerm:'',
                getproducts:[],
                customers:[],
                cartproducts:[],
                vats:[]
            }
        },

        computed: {
           filterSearch() {
             return this.products.filter (product => {
               return product.product_name.match(this.searchTerm)
             })
           },

            getfilterSearch() {
             return this.getproducts.filter (getproduct => {
               return getproduct.product_name.match(this.searchTerm)
             })
           }
        },

        methods: {
          AddToCart(id){
           axios.get('/api/addToCart/'+id)
              .then( () => {
                Reload.$emit('Afteradd')
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Added'
     });
              })
              .catch()
          },

          cartProduct() {
            axios.get('/api/cart/product/')
            .then(({data}) => this.cartproducts = data)
            .catch()
          },

          removeItem(id){
           axios.get('/api/remove/cart/'+id)
           .then(() => {
             Reload.$emit('Afteradd')
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully remove from cart'
     });

           })
          },

          increment(id) {
            axios.get('api/increment/'+id)
               .then(() => {
                 Reload.$emit('Afteradd')
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Incremeted'
     });

           })
          },

            decrement(id) {
               axios.get('api/decrement/'+id)
               .then(() => {
                 Reload.$emit('Afteradd')
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Decremented'
     });

           })
          },

          vat() {
               axios.get('/api/vats/')
               .then(({data}) => {
                 this.vats = data;
               })
               .catch()
          },

          qty() {
            let sum = 0;
            for(let i = 0; i< this.cartproducts.length; i++){
              sum += (parseFloat(this.cartproducts[i].pro_qty));

            }
            return sum;

          },


           subTotal() {
            let sum = 0;
            for(let i = 0; i< this.cartproducts.length; i++){
              sum += (parseFloat(this.cartproducts[i].pro_qty) * parseFloat(this.cartproducts[i].pro_price));

            }
            return sum;

          },

          orderDone(){
            let total = this.subTotal() * this.vats.vat /100 + this.subTotal();
            let data = {qty:this.qty, subTotal:this.subTotal, customer_id:this.customer_id, pay:this.pay, due:this.due,payby:this.payby,vat:this.vats.vat,total:total}

            axios.post('/api/orderdone',data)
                .then(() => {
                 Toast.fire({
                 icon: 'success',
                 title: 'successfully Done'
     });

     this.$router.push({name:'home'})

           })
          },




            allProduct(){
              axios.get('/api/product/')
              .then(({data}) => (this.products = data))
              .catch()
            },

               allCategoty(){
              axios.get('/api/category/')
              .then(({data}) => (this.categories = data))
              .catch()
            },

            subProduct(id){
              axios.get('/api/getting/product/'+id)
              .then(({data}) => (this.getproducts = data))
              .catch()
            },

                allCustomer(){
               axios.get('/api/customer/')
              .then(({data}) => (this.customers = data))
              .catch()
            },


        }
      
    }

</script>


<style scoped>

#em_photo {
  height: 100px;
  width: 135px;
}

</style>