<template>

    <div class="">



        <div class=" ">

        </div>

        <div class="d-flex justify-content-between py-3">

                    <h4>Sales Records</h4>

                    <a href="/export-sales" target="_blank" class="btn btn-primary">Export Sales Report</a>

        </div>

        <div class="card table-responsive">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-sm" placeholder="search...">
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-12 py-3">
                        <button class="btn btn-primary">search</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Customer
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                No of items
                            </th>
                            <th>
                               Total Amount
                            </th>

                            <th>
                                Date
                            </th>
                            <th>
                                Type
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="sale in invoices" :key="sale.id">
                            <td><a :href="'/invoice/' + sale.id" class="">{{ sale.customer?sale.customer.company_name:'u' }}    </a></td>
                            <td>
                                <span class="text-black " v-for="line in sale.invoice_line" :key="line.id">{{ line.product.name }},</span>
                              </td>
                            <td>{{( sale.invoice_line).length }}</td>

                            <td>NGN {{ format(sale.total_amount) }}</td>
                            <td>{{new Date(sale.created_at ).toLocaleDateString()}}</td>
                            <td>
                                <a :href="'/invoice/' + sale.id" class="btn btn-primary">
                                    {{ sale.invoice_type }}
                                </a>

                            </td>






                        </tr>
                    </tbody>
                </table>
            </div>
        </div>







    </div>



</template>

<script>


export default {



    data() {
        return {
            account_maps: [],
            key: '',
            my_maps: [],
            products: [],
            invoice: '',
            invoices: [],
            current_invoice_code: null,
            lineIds: [],
            lineQuantity:[],
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
            generating: false
        }
    },


    props: ['appurl', 'userid'],

    methods: {

        format(value){
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


                return window.open(this.appurl+'invoice/'+this.invoice.id, '_blank')




                //  this.results = response.data

            }).catch((err)=> {



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

        getCustomers(){
            axios({
                method: "get",
                url: this.appurl + 'api/customers',

            }).then((response)=>{

                this.customers = response.data,

                console.log(response)

            })
        },

        getCustomer(){
        return this.selCustomer;
        }
    },
    mounted() {

        console.log('Component mounted.');
        this.getProducts();
        this.createInvoice();
        this.getInvoices();
        this.getCustomers();

    }
}
</script>

<style scoped>
.switcher-wrapper{
    /* width: 400px;
    right: -384px; */
}
</style>
