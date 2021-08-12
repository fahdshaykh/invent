<template>
    <div>
        <div class="row">
            <router-link to="/all-supplier" class="btn btn-primary">All supplier</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add supplier</h1>
                        </div>
                        <form class="user" @submit.prevent="supplierInsert" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter full Name" v-model="form.name">
                                    <small class="text-danger" v-if="errors.name"> {{errors.name[0]}} </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address" v-model="form.email">
                                        <small class="text-danger" v-if="errors.email"> {{errors.email[0]}} </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter address" v-model="form.address">
                                    <small class="text-danger" v-if="errors.address"> {{errors.address[0]}} </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="number" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter phone" v-model="form.phone">
                                        <small class="text-danger" v-if="errors.phone"> {{errors.phone[0]}} </small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Shope Name" v-model="form.shope_name">
                                    <small class="text-danger" v-if="errors.shope_name"> {{errors.shope_name[0]}} </small>
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
                                    <img :src="form.photo" alt="" style="width:40px;height:40px">
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
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                address: null,
                phone: null,
                shop_name: null,
                photo: null
            },
            errors: {}
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
                  this.form.photo = event.target.result;
                  console.log(event.target.result);
              };
            reader.readAsDataURL(file);
          }
        },
        supplierInsert(){
            axios.post('/api/supplier', this.form)
            .then(() =>{
                this.$router.push({name: 'all-supplier'})
                Notification.success();
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}

</script>

<style>

</style>

