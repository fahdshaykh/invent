<template>
    <div>
        <div class="row">
            <router-link to="/all-employee" class="btn btn-primary">All Employee</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Employee</h1>
                        </div>
                        <form class="user" @submit.prevent="salaryUpdate" enctype="multipart/form-data">
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
                                    <input type="number" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Salary" v-model="form.salary">
                                        <small class="text-danger" v-if="errors.salary"> {{errors.salary[0]}} </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control" v-model="form.salary_month" id="exampleFormControlSelect1">
                                        <option value="January"> January </option>
                                        <option value="Febrary"> Febrary </option>
                                        <option value="March"> March </option>
                                        <option value="April"> April </option>
                                        <option value="May"> May </option>
                                        <option value="June"> June </option>
                                        <option value="July"> July </option>
                                        <option value="August"> August </option>
                                        <option value="September"> September </option>
                                        <option value="October"> October </option>
                                        <option value="November"> November </option>
                                        <option value="December"> December </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Pay Salary</button>
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
        axios.get('/api/employee/'+id)
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                salary: '',
                salary_month: ''
            },
            errors: {}
        }
    },
    methods: {
        salaryUpdate(){
            let id = this.$route.params.id;
            axios.post('/api/salary/paid/'+id, this.form)
            .then(() =>{
                this.$router.push({name: 'employee-list'})
                Notification.success();
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}

</script>

<style>

</style>

