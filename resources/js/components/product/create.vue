<template>
    <div>
        <div class="row">
            <router-link to="/all-product" class="btn btn-primary">All Product</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add product</h1>
                        </div>
                        <form class="user" @submit.prevent="productInsert" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Product Name" v-model="form.product_name">
                                    <small class="text-danger" v-if="errors.product_name"> {{errors.product_name[0]}} </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Product Code" v-model="form.product_code">
                                        <small class="text-danger" v-if="errors.product_code"> {{errors.product_code[0]}} </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control" v-model="form.category_id" id="exampleFormControlSelect1">
                                        <option :value="category.id" v-for="category in categories" :key="category.id">{{category.category_name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control" v-model="form.supplier_id" id="exampleFormControlSelect1">
                                        <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{supplier.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Product Root" v-model="form.root">
                                    <small class="text-danger" v-if="errors.root"> {{errors.root[0]}} </small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Product Buying Price" v-model="form.buying_price">
                                        <small class="text-danger" v-if="errors.buying_price"> {{errors.buying_price[0]}} </small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Product Selling Price" v-model="form.selling_price">
                                        <small class="text-danger" v-if="errors.selling_price"> {{errors.selling_price[0]}} </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Enter Buying Date" v-model="form.buying_date">
                                    <small class="text-danger" v-if="errors.buying_date"> {{errors.buying_date[0]}} </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Product Quantity" v-model="form.product_quantity">
                                        <small class="text-danger" v-if="errors.product_quantity"> {{errors.product_quantity[0]}} </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img :src="form.image" alt="" style="width:40px;height:40px">
                                </div>
                            </div>

                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <hr>
                        </form>

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

<script type="text/javascript">

export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name: '/'})
        }

        axios.get('/api/category/')
        .then(({data}) => (this.categories = data))

        axios.get('/api/supplier/')
        .then(({data}) => (this.suppliers = data))
    },
    data() {
        return {
            form: {
                product_name: null,
                product_code: null,
                root: null,
                buying_price: null,
                selling_price: null,
                category_id: null,
                supplier_id: null,
                buying_date: null,
                product_quantity: null,
                image: null
            },
            errors: {},
            categories: {},
            suppliers: {}
        }
    },
    methods: {
        onFileSelected(event){
          let file = event.target.files[0];
          if(file.size > 1048770){
              Notification.image_validation();
          } else {
              let reader = new FileReader();
              reader.onload = event => {
                  this.form.image = event.target.result;
                  console.log(event.target.result);
              };
            reader.readAsDataURL(file);
          }
        },
        productInsert(){
            axios.post('/api/product', this.form)
            .then(() =>{
                this.$router.push({name: 'all-product'})
                Notification.success();
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}

</script>

<style>

</style>

