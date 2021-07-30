
let login = require('./components/auth/login.vue').default;
let register1 = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forgetpsd.vue').default;
let home = require('./components/home.vue').default;
let logout = require('./components/auth/logout.vue').default;
//employee
let storeemployee = require('./components/Employee/create.vue').default;
let allemployee = require('./components/Employee/index.vue').default;
let editemployee = require('./components/Employee/edit.vue').default;
//supplier
let storesupplier = require('./components/Supplier/create.vue').default;
let allsupplier = require('./components/Supplier/index.vue').default;
let editsupplier = require('./components/Supplier/edit.vue').default;

//category
let storecategory = require('./components/Category/create.vue').default;
let allcategory = require('./components/Category/index.vue').default;
let editcategory = require('./components/Category/edit.vue').default;

//product
let storeproduct = require('./components/Product/create.vue').default;
let allproduct = require('./components/Product/index.vue').default;
let editproduct = require('./components/Product/edit.vue').default;
//expense
let storeexpense = require('./components/Expense/create.vue').default;
let allexpense = require('./components/Expense/index.vue').default;
let editexpense = require('./components/Expense/edit.vue').default;

//salary
let paysalary = require('./components/Salary/create.vue').default;
let allsalary = require('./components/Salary/index.vue').default;
let editsalary = require('./components/Salary/edit.vue').default;
let allemployeesalary = require('./components/Salary/all_employee.vue').default;

//customer
let storecustomer = require('./components/Customer/create.vue').default;
let allcustomer = require('./components/Customer/index.vue').default;
let editcustomer = require('./components/Customer/edit.vue').default;

//pos
let pos = require('./components/POS/pointofsale.vue').default;

let order = require('./components/Order/order.vue').default;
let vieworder = require('./components/Order/vieworder.vue').default;


export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/registerv2', component: register1, name:'register1' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/home', component: home, name:'home' },
    { path: '/logout', component: logout, name:'logout' },
    //employee
    { path: '/store-employee', component: storeemployee, name:'store-employee' },
    { path: '/all-employee', component: allemployee, name:'all-employee' },
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee' },

    //supplier
    { path: '/store-supplier', component: storesupplier, name:'store-supplier' },
    { path: '/all-supplier', component: allsupplier, name:'all-supplier' },
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier' },

    //catehory
    { path: '/store-category', component: storecategory, name:'store-category' },
    { path: '/all-category', component: allcategory, name:'all-category' },
    { path: '/edit-category/:id', component: editcategory, name:'edit-category' },

    //product
    { path: '/store-product', component: storeproduct, name:'store-product' },
    { path: '/all-product', component: allproduct, name:'all-product' },
    { path: '/edit-product/:id', component: editproduct, name:'edit-product' },

    //expense
    { path: '/store-expense', component: storeexpense, name:'store-expense' },
    { path: '/all-expense', component: allexpense, name:'all-expense' },
    { path: '/edit-expense/:id', component: editexpense, name:'edit-expense' },

    //salary
    { path: '/pay-salary/:id', component: paysalary, name:'pay-salary' },
    { path: '/all-salary', component: allsalary, name:'all-salary' },
    { path: '/edit-salary/:id', component: editsalary, name:'edit-salary' },
    { path: '/given-salary', component: allemployeesalary, name:'given-salary' },

    
    //customer
    { path: '/store-customer', component: storecustomer, name:'store-customer' },
    { path: '/all-customer', component: allcustomer, name:'all-customer' },
    { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer' },

    //pos
    { path: '/pos', component: pos, name:'pos' },
    { path: '/order', component: order, name:'order' },

    { path: '/view-order/:id', component: vieworder, name:'view-order' },





  ]