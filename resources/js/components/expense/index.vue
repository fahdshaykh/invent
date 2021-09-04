<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <router-link to="/store-expense" class="btn btn-primary">Add expense</router-link>
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" v-model="searchTerm" id="" class="form-control" placeholder="Enter name to search" style="width:70%">
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
                        <th>Amount</th>
                        <th>Expense Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filtersearch" :key="expense.id">
                        <td>{{ expense.amount }}</td>
                        <td>{{ expense.expense_date }}</td>
                        <td>
                            <router-link :to="{name: 'edit-expense', params: {id:expense.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteexpense(expense.id)" class="btn btn-sm btn-danger">Delete</a>
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
        this.allexpense();
    },
    data(){
        return {
            categories: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch(){
            return this.categories.filter(expense => {
                return expense.amount.match(this.searchTerm)
            });
        }
    },
    methods: {
        allexpense(){
            axios.get('/api/expense')
            .then(({data}) => (this.categories = data))
            .catch()
        },
        deleteexpense(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/api/expense/'+id)
                .then(() => {
                    this.categories = this.categories.filter(expense => {
                        return expense.id !=id;
                    })
                })
                .catch(() => {
                    this.$router.push({name: 'all-expense'})
                })

                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )}
            })
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

