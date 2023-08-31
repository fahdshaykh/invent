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
                  <a class="btn btn-sm btn-info"><font color="#ffffff">Add Customer</font></a>     
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" style="font-size: 12px">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in cart" :key="item.id">
                        <td>{{ item.product_name }}</td>
                        <td>
                          <div class="row">
                            <input class="mb-1" type="text" name="" id="" :value="item.product_quantity" style="width: 93%;">
                            <button class="btn btn-success" @click.prevent="incrementItem(item.id)"> + </button>
                            <button class="btn btn-danger" @click.prevent="decrementItem(item.id)" v-if="item.product_quantity >=2"> - </button>
                            <button class="btn btn-danger" v-else="" disabled=""> - </button>
                          </div>
                        </td>
                        <td>{{ item.product_price }}</td>
                        <td>{{ item.sub_total }}</td>
                        <td><a @click="removeItem(item.id)" class="btn btn-sm btn-danger" style="color: white;">X</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                      <strong>{{ qty }}</strong>
                      </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                      <strong>{{ subtotal }} $</strong>
                      </li>

                      <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
                      <strong>{{ vats.vat }} %</strong>
                      </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Total :
                        <strong>{{ subtotal * vats.vat / 100 + subtotal }} $</strong>
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
               
               
                 <!--  Category Wise Product -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product </a>
                  </li>
                  

                  <li class="nav-item" v-for="category in categories" :key="category.id">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)" >{{ category.category_name }}</a>
                  </li>


                  
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="card-body">
                    <input type="text" v-model="searchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                              <img :src="product.image" id="em_photo" class="card-img-top">
                              <div class="card-body">
                                <h6 class="card-title">{{ product.product_name }}</h6>
                        <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span> 
                        <span class="badge badge-danger" v-else=" ">Stock Out </span> 
                                
                              </div>
                            </div></button>
                          
                        </div>        
                      </div>

                    </div>


                  </div>  <!--  End TBAS HOME -->



                

                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                      <div class="card-body">
                    
                        <input type="text" v-model="getsearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                              <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">
                                  <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                      <img :src="getproduct.image" id="em_photo" class="card-img-top">
                                      <div class="card-body">
                                        <h6 class="card-title">{{ getproduct.product_name }}</h6>
                                        <span class="badge badge-success" v-if="getproduct.product_quantity  >= 1 ">Available {{ getproduct.product_quantity }}  </span> 
                                        <span class="badge badge-danger" v-else=" ">Stock Out </span> 
                                        
                                      </div>
                                  </div>
                              </button>
                          </div>        
                      </div>
                    </div>
                  </div>
                </div>
                    <!-- End Category Wise Product -->
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>
        <!---Container Fluid-->
</template>

<script type="text/javascript">

export default {
    created() {
      if(!User.loggedIn()) {
          this.$router.push({name: '/'})
      }
      this.allProduct();
      this.allCategory();
      this.allCustomer();
      this.cartProduct();
      this.vatsData();
      Reload.$on('AfterAdd', () => {
        this.cartProduct();
      })
    },
    data() {
        return {
          cart: [],
          products: [],
          categories:'',
          getproducts: [],
          customers: [],
          searchTerm: '',
          vats: ''
        }
    },
    computed: {
        filtersearch() {
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
            });
        },
        getfiltersearch() {
            return this.getproducts.filter(getproduct => {
                return getproduct.product_name.match(this.searchTerm)
          });
        },
        qty() {
          let sum = 0;

          for(let i = 0; i < this.cart.length; i++) {
            sum += (parseFloat(this.cart[i].product_quantity))
          }
          return sum;
        },
        subtotal() {
          let sum = 0;
          for(let i = 0; i < this.cart.length; i++) {
            sum += (parseFloat(this.cart[i].product_quantity) * parseFloat(this.cart[i].product_price))
          }
          return sum;
        }
    },
    methods: {
      AddToCart(id) {
        axios.get('/api/addToCart/'+id)
          .then(() => {
            Reload.$emit('AfterAdd');
            Notification.cart_success()
          })
          .catch()
      },
      removeItem(id) {
        axios.get('/api/removeToCart/'+id)
          .then(() => {
            Reload.$emit('AfterAdd');
            Notification.cart_success()
          })
          .catch()
      },
      incrementItem(id) {
        axios.get('/api/incrementToCart/'+id)
          .then(() => {
            Reload.$emit('AfterAdd');
            Notification.cart_success()
          })
          .catch()
      },
      decrementItem(id) {
        axios.get('/api/decrementToCart/'+id)
          .then(() => {
            Reload.$emit('AfterAdd');
            Notification.cart_success()
          })
          .catch()
      },
      vatsData() {
        axios.get('/api/vats')
          .then(({data}) => (this.vats = data))
          .catch()
      },
      cartProduct() {
        axios.get('/api/cart/product')
          .then(({data}) => (this.cart = data))
          .catch()
      },
      allProduct() {
          axios.get('/api/product')
          .then(({data}) => (this.products = data))
          .catch()
      },
      allCategory() {
          axios.get('/api/category')
          .then(({data}) => (this.categories = data))
          .catch()
      },
      subProduct(id) {
          axios.get('/api/getting/product/'+id)
          .then(({data}) => (this.getproducts = data))
          .catch()
      },
      allCustomer() {
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

