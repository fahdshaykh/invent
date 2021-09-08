<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <router-link to="/add-employee" class="btn btn-primary">Add Employee</router-link>
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
                        <th>Salary Month</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filtersearch" :key="salary.id">
                        <td>{{ salary.salary_month }}</td>
                        <td>
                            <router-link :to="{name: 'view-salary', params: {month:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>
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
        this.allSalary();
    },
    data(){
        return {
            salaries: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch(){
            return this.salaries.filter(salary => {
                return salary.salary_month.match(this.searchTerm)
            });
        }
    },
    methods: {
        allSalary(){
            axios.get('/api/salary')
            .then(({data}) => (this.salaries = data))
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

