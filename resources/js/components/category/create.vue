<template>
    <div>
        <div class="row">
            <router-link to="/all-category" class="btn btn-primary">All category</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add category</h1>
                        </div>
                        <form class="user" @submit.prevent="categoryInsert" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter full Name" v-model="form.category_name">
                                    <small class="text-danger" v-if="errors.category_name"> {{errors.category_name[0]}} </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Note" v-model="form.category_note"></textarea>
                                    <small class="text-danger" v-if="errors.category_note"> {{errors.category_note[0]}} </small>
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
                category_name: null,
                category_note: null
            },
            errors: {}
        }
    },
    methods: {
        categoryInsert(){
            axios.post('/api/category', this.form)
            .then(() =>{
                this.$router.push({name: 'all-category'})
                Notification.success();
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}

</script>

<style>

</style>

