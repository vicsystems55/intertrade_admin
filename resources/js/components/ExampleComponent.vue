<template>

    <div class="">

        <div class=" ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 ">


                            <div style="height: 450px; overflow-y: scroll; overflow-x: hidden;" class="p-2">

                                <div class="row">
                                    <div v-for="product in products" :key="product.id"
                                        class="col-lg-4 col-md-6 mx-auto">
                                        <div class="card" style="min-width: 200px;">
                                            <img style="height: 200px; max-width:200px;" :src="product.featured_image" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ product.name }}</h6>
                                                <p class="card-text">{{ product.description }}</p>
                                                <p v-if="product.stock_sum_quantity">In stock: {{product.stock_sum_quantity }}</p>
                                                <p v-else>In stock: 0</p>
                                                <p>N {{ format(product.price) }}</p>
                                                <button
                                                v-if="product.stock_sum_quantity"
                                                @click="addProduct(product.id)"
                                                    class="btn btn-primary btn-sm col-12">Add +</button>

                                                    <button
                                                    v-else
                                                    class="btn btn-primary btn-sm col-12" disabled>Add +</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                            </div>



                    </div>
                    <div class="col-md-4 ">
                        <div class="card card-bod">
                            <h6 class="pt-3 px-3">Record Sale</h6>


                            <div style="height: 320px; overflow-y: auto;" class="px-5">


                                <div class="form-group p-1 ">
                                    <label for="">Select Customer <span class="text-danger">*</span></label>
                                    <select v-model="selCustomer" @change="getCustomer" class="form-control">
                                        <option :value="'Please select customer'"  >-Pick a customer-</option>
                                        <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.company_name}} {{ customer.conact_person_name }}</option>



                                    </select>
                                </div>

                                <hr>


                                <div v-for="line,key in invoice.invoice_line" :key="line.id"  class="card border mb-2 p-2 border border-primary">
                                    <div class="row ">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <div  class="c ">
                                                    <h6 style="font-weight: bold;">
                                                       {{key + 1 }}. {{ line.product.name }}
                                                    </h6>

                                                </div>
                                                <div class="r ">
                                                    <span @click="removeInvoiceLine(line.id)"  class="btn p-0 px-1 text-white h6 bg-danger">x</span>

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

                                                            v-model="lineQuantity[key]" >

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-group py-2">
                                            <label for="desc">Description</label>
                                            <textarea class="form-control" v-model="lineDescription[key]" rows="1"></textarea>
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
                                        <option >Paid</option>
                                        <option >Unpaid</option>
                                    </select>
                                </div>

                                <div class="form-group p-1 py-2">
                                    <input class="form-check-input" v-model="vat_included" type="checkbox"  id="flexCheckDefault">
                                    <label class="form-check-label text-danger" for="flexCheckDefault">
                                        VAT Included
                                    </label>
                                </div>

                                <div class="form-group p-1 py-2">
                                    <input class="form-check-input" v-model="generate_receipt" type="checkbox"  id="flexCheckDefault2">
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
                                <button @click="generateInvoice()" class="btn btn-primary col-12">{{generating==true?'Generating...':'Submit'}}</button>
                            </div>

                            <div class="form-group p-2">
                                <button @click="resetInvoice()" class="btn btn-danger col-12">Reset</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>


        <h4>Sales Records</h4>

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
                            <td>{{ sale.invoice_type }}</td>






                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <h4>Invoices</h4>

        <div class="card table-responsive">
            <div class="card-body">
                <table class="table">

                    <thead>
                        <tr>
                            <th>Invoice Code</th>
                            <th>Total Amount</th>
                            <th>Type</th>
                            <th>Created at</th>
                            <th>Date</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr v-for="inv in invoices" :key="inv.id">
                            <td>{{ inv.invoice_code }}</td>
                            <td>N {{ format(inv.total_amount) }}</td>
                            <td>{{ inv.invoice_type }}</td>
                            <td>{{ inv.created_at }}</td>

                            <td>

                                <a v-if="inv.invoice_type == 'receipt'" href="">
                                    <a :href="'/invoice/' + inv.id" class="btn btn-success">view {{inv.invoice_type}}</a>
                                </a>
                                <a v-else href="">

                                    <a :href="'/invoice/' + inv.id" class="btn btn-primary">view {{inv.invoice_type}}</a>
                                </a>
                                <!-- <a :href="'/invoice/' + inv.id" class="btn btn-warning">view {{inv.invoice_type}}</a> -->
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
            generate_receipt: false,
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
