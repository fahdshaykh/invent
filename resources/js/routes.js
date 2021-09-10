let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;

//employee
let allemployee = require('./components/employee/index.vue').default;
let storeemployee = require('./components/employee/create.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

//supplier
let allsupplier = require('./components/supplier/index.vue').default;
let storesupplier = require('./components/supplier/create.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

//category
let allcategory = require('./components/category/index.vue').default;
let storecategory = require('./components/category/create.vue').default;
let editcategory = require('./components/category/edit.vue').default;

//product
let allproduct = require('./components/product/index.vue').default;
let storeproduct = require('./components/product/create.vue').default;
let editproduct = require('./components/product/edit.vue').default;

//expense
let allexpense = require('./components/expense/index.vue').default;
let storeexpense = require('./components/expense/create.vue').default;
let editexpense = require('./components/expense/edit.vue').default;

//salary
let employeelist = require('./components/salary/employee_list.vue').default;
let paysalary = require('./components/salary/create.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/view.vue').default;
let editsalary = require('./components/salary/edit.vue').default;

//stock
let allstock = require('./components/stock/index.vue').default;
let editstock = require('./components/stock/edit.vue').default;

//customer
let allcustomer = require('./components/customer/index.vue').default;
let storecustomer = require('./components/customer/create.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;


export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },

    { path: '/all-employee', component: allemployee, name:'all-employee' },
    { path: '/store-employee', component: storeemployee, name:'store-employee' },
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee' },

    { path: '/all-supplier', component: allsupplier, name:'all-supplier' },
    { path: '/store-supplier', component: storesupplier, name:'store-supplier' },
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier' },

    { path: '/all-category', component: allcategory, name:'all-category' },
    { path: '/store-category', component: storecategory, name:'store-category' },
    { path: '/edit-category/:id', component: editcategory, name:'edit-category' },

    { path: '/all-product', component: allproduct, name:'all-product' },
    { path: '/store-product', component: storeproduct, name:'store-product' },
    { path: '/edit-product/:id', component: editproduct, name:'edit-product' },

    { path: '/all-expense', component: allexpense, name:'all-expense' },
    { path: '/store-expense', component: storeexpense, name:'store-expense' },
    { path: '/edit-expense/:id', component: editexpense, name:'edit-expense' },

    { path: '/employee-list', component: employeelist, name:'employee-list' },
    { path: '/pay-salary/:id', component: paysalary, name:'pay-salary' },
    { path: '/salary', component: allsalary, name:'salary' },
    { path: '/view-salary/:month', component: viewsalary, name:'view-salary' },
    { path: '/edit-salary/:id', component: editsalary, name:'edit-salary' },

    { path: '/stock', component: allstock, name:'all-stock' },
    { path: '/edit-stock/:id', component: editstock, name:'edit-stock' },

    { path: '/all-customer', component: allcustomer, name:'all-customer' },
    { path: '/store-customer', component: storecustomer, name:'store-customer' },
    { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer' },
]
