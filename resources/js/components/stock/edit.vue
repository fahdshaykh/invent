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
                        <form class="user" @submit.prevent="stockUpdate" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Product Name" v-model="form.product_quantity">
                                    <small class="text-danger" v-if="errors.product_quantity"> {{errors.product_quantity[0]}} </small>
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

        let id = this.$route.params.id;
        axios.get('/api/product/'+id)
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
    },
    data() {
        return {
            form: {
                product_quantity: '',
            },
            errors: {}
        }
    },
    methods: {
        stockUpdate(){

            let id = this.$route.params.id;
            axios.post('/api/stock-update/'+id, this.form)
            .then(() =>{
                this.$router.push({name: 'all-stock'})
                Notification.success();
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}

</script>

<style>

</style>

