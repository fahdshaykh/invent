<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <router-link to="/add-supplier" class="btn btn-primary">Add supplier</router-link>
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
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filtersearch" :key="supplier.id">
                        <td>{{ supplier.name }}</td>
                        <td><img :src="supplier.photo" alt="" id="emp_photo"></td>
                        <td>{{ supplier.email }}</td>
                        <td>{{ supplier.phone }}</td>
                        <td>
                            <router-link :to="{name: 'edit-supplier', params: {id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
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
        this.allSupplier();
    },
    data(){
        return {
            suppliers: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch(){
            return this.suppliers.filter(supplier => {
                return supplier.phone.match(this.searchTerm)
            });
        }
    },
    methods: {
        allSupplier(){
            axios.get('/api/supplier')
            .then(({data}) => (this.suppliers = data))
            .catch()
        },
        deleteSupplier(id){
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
                axios.delete('/api/supplier/'+id)
                .then(() => {
                    this.suppliers = this.suppliers.filter(supplier => {
                        return supplier.id !=id;
                    })
                })
                .catch(() => {
                    this.$router.push({name: 'all-supplier'})
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

