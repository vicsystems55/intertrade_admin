<template>

    <div class="">

        <div class=" ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="">
                            <h6>Stock</h6>
                            <div style="height: 400px; overflow: scroll;" class="c">

                                <div class="row">
                                    <div v-for="product in products" :key="product.id" class="col-md-4">
                                        <div class="card" style="width: 220px;">
                                            <img :src="product.featured_image" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ product.name }}</h6>
                                                <p class="card-text">{{ product.description }}</p>
                                                <button @click="addProduct(product.id)" class="btn btn-primary btn-sm col-12">Add +</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                            </div>

                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <h6>Record Sale</h6>
                        <div class="card card-body">

                            <div style="max-height: 320px; overflow: scroll;" class="">

                                <div class="form-group mb-3">
                                    <label for="">Select Customer</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">Customer 1</option>
                                        <option value="">Customer 1</option>

                                        <option value="">Customer 1</option>


                                    </select>
                                </div>

                                <div v-for="line in invoice.invoice_line" :key="line.id"  class="inln">
                                    <div class="row">
                                    <div class="col-8">
                                        <h6> {{line.product.name}}</h6>
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-sm">

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        N 23,000
                                    </div>
                                </div>
                                <hr>
                                </div>


                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary col-12">Submit</button>
                            </div>

                        </div>

                    </div>
                </div>

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
                            <th>Created by</th>
                            <th>Date</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr v-for="inv in invoices" :key="inv.id">
                            <td>{{inv.invoice_code}}</td>
                            <td>{{ inv.discount_amount}}</td>
                            <td>{{ inv.created_at}}</td>
                            <td></td>
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
            current_invoice_code: null
        }
    },


    props: ['appurl', 'userid'],

    methods: {
        generate_voucher() {


        },

        addProduct(productId){

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

                    this.getInvoice()
                    //  this.results = response.data

                )).catch(function (error) {
                    console.log(error);
                });



        },

        createInvoice() {


            if (localStorage.getItem('current_invoice_code')) {

                alert('has');

                this.getInvoice();

            } else {

                localStorage.setItem('current_invoice_code', Date.now());

                this.current_invoice_code = localStorage.getItem('current_invoice_code');

                alert('created')

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

                this.invoice = response.data,

                console.log(response)
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
        getInvoices(){
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
        }


    },
    mounted() {





        console.log('Component mounted.');
        this.getProducts();
        this.createInvoice();
        this.getInvoices();

    }
}
</script>
