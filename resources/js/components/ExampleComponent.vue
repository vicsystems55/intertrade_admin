<template>

    <div class="">

        <div class="switcher-wrapper">
            <div class="switcher-btn"> <i class="bx bx-cog bx-spin"></i>
            </div>
            <div class="switcher-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-uppercase">Record Sale</h5>
                    <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
                </div>
                <hr>

                <div class=" ">
                    <div class="car">


                        <div class="form-group p-1 ">
                            <label for="">Select Customer <span class="text-danger">*</span></label>
                            <select v-model="selCustomer" @change="getCustomer" class="form-control">
                                <option :value="'Please select customer'">-Pick a customer-</option>
                                <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                    {{ customer.company_name }} {{ customer.conact_person_name }}</option>



                            </select>
                        </div>

                        <hr>

                        <div style="height: 400px; overflow-y: auto;" class="">




                            <div v-for="line, key in invoice.invoice_line" :key="line.id"
                                class="card border mb-2 p-2 border border-primary">
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="c ">
                                                <h6 style="font-weight: bold;">
                                                    {{ key + 1 }}. {{ line.product.name }}
                                                </h6>

                                            </div>
                                            <div class="r ">
                                                <span @click="removeInvoiceLine(line.id)"
                                                    class="btn p-0 px-1 text-white h6 bg-danger">x</span>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" name="" v-model="lineIds[key]">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control form-control-sm"
                                                        v-model="linePrice[key]">
                                                </div>
                                                <div class="col-4">
                                                    <label for="quantity">Quantity</label>

                                                    <input type="number" class="form-control form-control-sm"
                                                        v-model="lineQuantity[key]">

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group py-2">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control" v-model="lineDescription[key]"
                                            rows="1"></textarea>
                                    </div>
                                </div>

                            </div>




                            <hr>



                            <div class="form-group p-1">
                                <label for="">Select Type <span class="text-danger">*</span> </label>
                                <select v-model="invoice_type" id="" class="form-control ">


                                    <option :value="'Invoice'">Invoice</option>
                                    <option :value="'Quotation'">Quotation</option>
                                    <option :value="'Pro forma Invoice'">Pro forma Invoice</option>
                                    <!-- <option :value="'receipt'">Receipt</option> -->


                                </select>
                            </div>

                            <div class="form-group p-1">
                                <label for="">Status</label>
                                <select v-model="payment_status" id="" class="form-control">
                                    <option>Paid</option>
                                    <option>Unpaid</option>
                                </select>
                            </div>

                            <div class="form-group p-1 py-2">
                                <input class="form-check-input" v-model="vat_included" type="checkbox"
                                    id="flexCheckDefault">
                                <label class="form-check-label text-danger" for="flexCheckDefault">
                                    VAT Included
                                </label>
                            </div>

                            <div class="form-group p-1 py-2">
                                <input class="form-check-input" v-model="generate_receipt" :value="'true'"
                                    type="checkbox" id="flexCheckDefault2">
                                <label class="form-check-label text-danger" for="flexCheckDefault2">
                                    Generate Receipt
                                </label>
                            </div>

                            <div class="form-group p-1">
                                <label for="">Bank Name</label>
                                <input type="text" v-model="bank_name" class="form-control">
                                <label for="">Account Name</label>
                                <input type="text" v-model="account_name" class="form-control">
                                <label for="">Account No.</label>
                                <input type="text" v-model="account_no" class="form-control">
                            </div>




                        </div>
                        <div class="form-group p-2">
                            <button @click="generateInvoice()" class="btn btn-primary col-12">{{ generating == true ?
                                'Generating...' : 'Submit' }}</button>
                        </div>

                        <div class="form-group p-2">
                            <button @click="resetInvoice()" class="btn btn-danger col-12">Reset</button>
                        </div>

                    </div>

                </div>


            </div>
        </div>

        <div class=" ">
            <div class="container-fluid">

                <div class="form-group col-md-6 py-2 d-flex">
                    <input type="text" class="form-control" v-model="searchKey" placeholder="Search a product">
                    <button @click="searchProducts()" class="btn btn-primary">Search</button>
                </div>

                <div class="cat d-flex flex-wrap justify-content-start py-2">

                    <button v-for="productCategory in productCategories" :key="productCategory.id"
                        @click="sortProducts(productCategory.id)" type="button" class="btn btn-primary m-1">{{
                        productCategory.name }} <span class="badge bg-dark">{{
                            productCategory.products_count }}</span></button>

                </div>

                <div class="row">
                    <div class="col-md-12 ">

                        <div class="py-4">Resutls: {{ products.length }}</div>


                        <div v-if="loading" class="loader d-flex justify-content-center align-items-center"
                            style="height: 340px;">

                            <h6>Loading...</h6>


                        </div>


                        <div v-else class="p-2">

                            <div class="row">

                                
                                <div v-for="product in products" :key="product.id" class="col-lg-3 col-md-4 mx-auto">
                                    <div class="card" style="max-width: 300px;">
                                        <img style="max-height: 200px; max-width:300px; object-fit: cover;"
                                            :src="product.featured_image" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ product.name }}</h6>
                                            <p class="card-text">{{ product.description }}</p>
                                            <p v-if="product.stock_sum_quantity">In stock: {{ product.stock_sum_quantity
                                                }}</p>
                                            <p v-else>In stock: 0</p>
                                            <p>N {{ format(product.price) }}</p>
                                            <button v-if="product.stock_sum_quantity" @click="addProduct(product.id)"
                                                class="btn btn-primary btn-sm col-12">Add +</button>

                                            <button v-else class="btn btn-primary btn-sm col-12" disabled>Add +</button>
                                        </div>
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

<script>


export default {



    data() {
        return {
            searchKey: '',
            account_maps: [],
            key: '',
            my_maps: [],
            products: [],
            productCategories: [],
            invoice: '',
            invoices: [],
            current_invoice_code: null,
            lineIds: [],
            lineQuantity: [],
            lineDescription: [],
            linePrice: [],
            vat_included: false,
            generate_receipt: 'false',
            customers: [],
            selCustomer: 'Please select customer',
            invoice_type: 'Invoice',
            payment_status: 'Unpaid',

            bank_name: 'UBA',
            account_name: 'InterTrade Ltd.',
            account_no: '22002288220',
            generating: false,
            loading: false,
            searchKey: '',
        }
    },


    props: ['appurl', 'userid'],

    methods: {

        format(value) {
            var numeral = require('numeral');

            return numeral(value).format('N 0,0.00')
        },

        async generateInvoice() {
            //  alert(this.generate_receipt)

            //  alert(this.selCustomer)

            if (this.selCustomer == null) {
                return alert('Please select a customer')
            }


            if (this.invoice_type == null) {
                return alert('Please document type')
            }
            this.generating = true
            // console.log(this.lineQuantity)

            // var desc = [];

            // desc = document.getElementById('quantity').value

            // console.log(desc);

            await axios({
                method: "post",
                url: this.appurl + 'api/invoice_lines',
                params: {
                    lineIds: this.lineIds,
                    lineDescription: this.lineDescription,
                    lineQuantity: this.lineQuantity,
                    linePrice: this.linePrice,
                    type: 'update-line',
                    invoice_id: this.invoice.id,

                    customer_id: this.selCustomer,
                    invoice_type: this.invoice_type,
                    vat_included: this.vat_included,
                    generate_receipt: this.generate_receipt,


                    bank_name: this.bank_name,
                    account_name: this.account_name,
                    account_no: this.account_no,
                    user_id: this.userid
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },

            }).then((response) => {
                // this.loading = false,

                // alert('no'),

                console.log(response)

                this.resetInvoice()

                this.generating = false


                return window.open(this.appurl + 'invoice/' + this.invoice.id, '_blank')




                //  this.results = response.data

            }).catch((err) => {

                // console.log(error);
                this.generating = false

            });


        },

        addProduct(productId) {

            //alert(this.invoice.id)

            axios.post(this.appurl + 'api/invoices', {
                invoice_id: this.invoice.id,
                product_id: productId,
                type: 'add-product'
                // date: this.date,
                // file_upload: this.newfile_name,
                // text_report: this.outputData.blocks,

            }).then((response) => (
                // this.loading = false,

                this.invoice = response.data,

                console.log(response),

                this.getInvoice(),
                //  this.results = response.data

                alert('Prduct Added to list.')

            )).catch(function (error) {
                console.log(error);
            });



        },

        createInvoice() {


            if (localStorage.getItem('current_invoice_code')) {

                // alert('has');

                this.getInvoice();

            } else {

                localStorage.setItem('current_invoice_code', Date.now());

                this.current_invoice_code = localStorage.getItem('current_invoice_code');

                //alert('created')

                axios.post(this.appurl + 'api/invoices', {
                    invoice_code: this.current_invoice_code,
                    userid: this.userid
                    // date: this.date,
                    // file_upload: this.newfile_name,
                    // text_report: this.outputData.blocks,

                }).then((response) => (
                    // this.loading = false,

                    this.invoice = response.data,

                    console.log(response),

                    this.getInvoice()
                    //  this.results = response.data

                )).catch(function (error) {
                    console.log(error);
                });

            }



        },

        getInvoice() {
            axios({
                method: "get",
                url: this.appurl + 'api/invoices',
                params: {
                    invoice_code: localStorage.getItem('current_invoice_code'),

                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },

            }).then((response) => (
                // this.loading = false,

                //alert('reveic curent invoice'),

                this.invoice = response.data,



                this.lineQuantity = response.data.invoice_line.map(line => line.quantity),
                console.log(this.lineQuantity),

                this.lineDescription = response.data.invoice_line.map(line => line.description),
                console.log(this.lineDescription),

                this.lineIds = response.data.invoice_line.map(line => line.id),
                console.log(this.lineIds),

                this.linePrice = response.data.invoice_line.map(line => line.product.price),
                console.log(this.linePrice),

                console.log(response)

                //alert('this.invoice')

                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
            });
        },

        sortProducts(productCategory_id) {


            this.loading = true

            axios({
                method: "get",
                url: this.appurl + 'api/products-search',
                params: {
                    productCategoryId: productCategory_id,

                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },

            }).then((response) => (
                // this.loading = false,

                this.products = response.data,
                console.log('can sort'),
                console.log(response),

                this.loading = false

                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
                this.loading = false

            });


        },

        searchProducts() {

            this.loading = true

            axios({
                method: "get",
                url: this.appurl + 'api/products-search-keyword',
                params: {
                    searchKey: this.searchKey,
                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },

            }).then((response) => (
                // this.loading = false,

                this.products = response.data,
                console.log('can sort'),
                console.log(response),

                this.loading = false

                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
                this.loading = false

            });

        },

        getProducts() {
            axios.get(this.appurl + 'api/products', {
                key: this.key,
                // date: this.date,
                // file_upload: this.newfile_name,
                // text_report: this.outputData.blocks,

            }).then((response) => (
                // this.loading = false,

                this.products = response.data,

                console.log(response)
                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
            });

        },

        getProductCategories() {
            axios.get(this.appurl + 'api/product-category', {
                key: this.key,
                // date: this.date,
                // file_upload: this.newfile_name,
                // text_report: this.outputData.blocks,

            }).then((response) => (
                // this.loading = false,

                this.productCategories = response.data,

                console.log(response)
                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
            });

        },

        getInvoices() {
            axios({
                method: "get",
                url: this.appurl + 'api/invoices',
                params: {
                    type: 'all',

                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },

            }).then((response) => (
                // this.loading = false,

                this.invoices = response.data,

                console.log(response)
                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
            });
        },

        async resetInvoice() {
            // axios({
            //     method: "post",
            //     url: this.appurl + 'api/invoices',
            //     params: {
            //         invoice_code: localStorage.getItem('current_invoice_code'),
            //         type: 'delete'

            //     },
            //     headers: {
            //         'Access-Control-Allow-Origin': '*',
            //         'Content-type': 'application/json',
            //         'Accept': 'application/json',
            //     },

            // }).then((response) => (
            //     // this.loading = false,

            //     //alert('reveic curent invoice'),

            //     // this.invoice = response.data,
            //     console.log(response)

            //     //alert('this.invoice')

            //     //  this.results = response.data

            // )).catch(function (error) {
            //     console.log(error);
            // });

            localStorage.removeItem('current_invoice_code');

            await this.createInvoice()

            console.log('Invoice Refreshed!!')

        },

        removeInvoiceLine(invoiceLineId) {

            axios({
                method: "post",
                url: this.appurl + 'api/invoice_lines',
                params: {
                    invoice_line_id: invoiceLineId,
                    type: 'remove-item'

                },
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                },

            }).then((response) => (
                // this.loading = false,

                //alert('reveic curent invoice'),

                // this.invoice = response.data,
                console.log(response),
                this.getInvoice()

                //alert('this.invoice')

                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
            });

        },

        getCustomers() {
            axios({
                method: "get",
                url: this.appurl + 'api/customers',

            }).then((response) => {

                this.customers = response.data,

                    console.log(response)

            })
        },

        getCustomer() {
            return this.selCustomer;
        }
    },
    mounted() {

        console.log('Component mounted.');
        this.getProducts();
        this.getProductCategories();
        this.createInvoice();
        this.getInvoices();
        this.getCustomers();

    }
}
</script>

<style scoped>
.switcher-wrapper {
    /* width: 400px;
    right: -384px; */
}
</style>
