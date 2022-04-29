<template>
    <div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>

                </div>




                <div class="table-responsive">
                  <table class="table align-items-center table-flush" style="font-size: 12px">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#">RA0449</a></td>
                        <td>Udin Wayang</td>
                        <td>Nasi Padang</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA0449</a></td>
                        <td>Udin Wayang</td>
                        <td>Nasi Padang</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA0449</a></td>
                        <td>Udin Wayang</td>
                        <td>Nasi Padang</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">



                    <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>344$</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong>344 $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>56 %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong>5587 $</strong>
   </li>

            </ul>

            <br>

        <form @submit.prevent="orderdone">
          <label>Customer Name</label>
          <select class="form-control" v-model="customer_id">
         <option :value="customer.id" v-for="customer in customers" :key="customer.id">{{customer.name }} </option>

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




<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
    <li v-for="category in categories" :key="category.id">
    <a @click="subProduct(category.id)" class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
      {{ category.category_name }}
    </a>
    </li>
  
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="card-body">
          <div class="col-md-12">
              <input type="text" v-model="searchTerm" id="" class="form-control" placeholder="Enter Phone to search" style="width:70%">
          </div>

          <div class="row">
              <div class="col-md-3 col-lg-3 col-sm-6" v-for="product in filtersearch" :key="product.id">
                  <div class="card" style="width: 8.5rem;">
                      <img class="card-img-top" id="emp_photo" :src="product.image" alt="Card image cap">
                      <div class="card-body">

                          <h5 class="card-title">{{ product.product_name }}</h5>
                          <span v-if="product.product_quantity >= 1" class="badge badge-success">Available {{product.product_quantity}}</span>

                          <span v-else class="badge badge-danger">Stock-Out</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    
    <div class="card-body">
          <div class="col-md-12">
              <input type="text" v-model="searchTerm" id="" class="form-control" placeholder="Enter Phone to search" style="width:70%">
          </div>

          <div class="row">
              <div class="col-md-3 col-lg-3 col-sm-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                  <div class="card" style="width: 8.5rem;">
                      <img class="card-img-top" id="emp_photo" :src="getproduct.image" alt="Card image cap">
                      <div class="card-body">

                          <h5 class="card-title">{{ getproduct.product_name }}</h5>
                          <span v-if="getproduct.product_quantity >= 1" class="badge badge-success">Available {{getproduct.product_quantity}}</span>

                          <span v-else class="badge badge-danger">Stock-Out</span>
                      </div>
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
        <!---Container Fluid-->

    </div>
</template>

<script type="text/javascript">

export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name: '/'})
        }
        this.allProduct();
        this.allCategory();
        this.allCustomer();
    },
    data(){
        return {
            products: [],
            categories:'',
            getproducts: [],
            customers: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch(){
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
            });
        },
        getfiltersearch(){
            return this.getproducts.filter(product => {
                return getproduct.product_name.match(this.searchTerm)
            });
        }
    },
    methods: {
        allProduct(){
            axios.get('/api/product')
            .then(({data}) => (this.products = data))
            .catch()
        },
        allCategory(){
            axios.get('/api/category')
            .then(({data}) => (this.categories = data))
            .catch()
        },
        subProduct(id){
            axios.get('/api/getting/product/'+id)
            .then(({data}) => (this.getproducts = data))
            .catch()
        },
        allCustomer(){
            axios.get('/api/customer')
            .then(({data}) => (this.customers = data))
            .catch()
        },
    }
}

</script>

<style>
#emp_photo {
    width: 95px;
    height: 135px;
}
</style>

