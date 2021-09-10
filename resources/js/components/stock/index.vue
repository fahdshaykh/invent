<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <router-link to="/store-product" class="btn btn-primary">Add product</router-link>
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" v-model="searchTerm" id="" class="form-control" placeholder="Enter Phone to search" style="width:70%">
                </div>
            </div>
        </div>

<br><br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>category</th>
                        <th>Photo</th>
                        <th>Buyinig Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filtersearch" :key="product.id">
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.product_code }}</td>
                        <td>{{ product.categories.category_name }}</td>
                        <td><img :src="product.image" alt="" id="emp_photo"></td>
                        <td>{{ product.buying_price }}</td>
                        <td v-if="product.product_quantity >= 1">
                            <span class="badge badge-success">Available</span>
                        </td>
                        <td v-else>
                            <span class="badge badge-danger">Stock-Out</span>
                        </td>
                        <td>{{ product.product_quantity }}</td>
                        <td>
                            <router-link :to="{name: 'edit-stock', params: {id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
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

<script type="text/javascript">

export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name: '/'})
        }
        this.allProduct();
    },
    data(){
        return {
            products: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch(){
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
            });
        }
    },
    methods: {
        allProduct(){
            axios.get('/api/product')
            .then(({data}) => (this.products = data))
            .catch()
        }
    }
}

</script>

<style>
#emp_photo {
    width: 40px;
    height: 40px;
}
</style>

