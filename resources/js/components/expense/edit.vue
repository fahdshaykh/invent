<template>
    <div>
        <div class="row">
            <router-link to="/all-expense" class="btn btn-primary">All expense</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add expense</h1>
                        </div>
                        <form class="user" @submit.prevent="expenseUpdate" enctype="multipart/form-data">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <input type="number" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Empoyee number" v-model="form.amount">
                                        <small class="text-danger" v-if="errors.amount"> {{errors.amount[0]}} </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Enter joining date" v-model="form.expense_date">
                                    <small class="text-danger" v-if="errors.expense_date"> {{errors.expense_date[0]}} </small>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Note" v-model="form.details"></textarea>
                                    <small class="text-danger" v-if="errors.details"> {{errors.details[0]}} </small>
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
        axios.get('/api/expense/'+id)
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
    },
    data() {
        return {
            form: {
                amount: '',
                expense_datet: '',
                details: '',
            },
            errors: {}
        }
    },
    methods: {
        expenseUpdate(){
            let id = this.$route.params.id;
            axios.patch('/api/expense/'+id, this.form)
            .then(() =>{
                this.$router.push({name: 'all-expense'})
                Notification.success();
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}

</script>

<style>

</style>

