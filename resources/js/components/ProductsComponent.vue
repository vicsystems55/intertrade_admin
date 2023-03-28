<template>
    <div class="card p-2 table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Category</th>
                    <th>Price (N)jk</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>
                <tr v-for="product, key in products" :key="product.id">
                    <td>{{ key + 1 }}</td>
                    <td>
                        <img style="height: 90px; width: 90px; object-fit: cover;" :src="product.featured_image"
                            class="card-img-top" alt="...">

                    </td>

                    <td>
                        <input type="text" class="form-control form-control-sm" :id="'productName' + product.id"
                            :value="product.name">

                    </td>

                    <td>
                        <input type="text" class="form-control form-control-sm" :id="'productDescription' + product.id"
                            :value="product.description">

                    </td>

                    <td>
    <select

    :id="'productCategory' + product.id"

    class="form-control form-control-sm">

    <option v-for="productCategory in productsCategories"

        :key="productCategory.id"

        :value="productCategory.id"

        :selected="product.product_category_id == productCategory.id ? true : false">

        {{productCategory.name }}

    </option>

    </select>

                    </td>

                    <td>
                        <input type="text" class="form-control form-control-sm" :id="'productPrice' + product.id"
                            :value="product.price">

                    </td>
                    <td>

                        <button @click=updateProduct(product.id) class="btn btn-info btn-sm"
                            :id="'productBtn' + product.id">
                            Update
                        </button>
                    </td>




                </tr>
            </tbody>
        </table>

    </div>
</template>
<script>
export default {
    data() {
        return {
            products: [],

            productsCategories: [],

            loading: false
        }
    },

    mounted() {
        console.log('Products component mounted.');

        this.getProducts()

        this.getProductCategories()
    },

    props: ['appurl', 'userid'],

    methods: {
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

                this.productsCategories = response.data,

                console.log(response)
                //  this.results = response.data

            )).catch(function (error) {
                console.log(error);
            });

        },

        updateProduct(pId) {

            this.loading = true

            let productName = document.getElementById('productName' + pId).value;
            let productDescription = document.getElementById('productDescription' + pId).value;
            let productCategory = document.getElementById('productCategory' + pId).value;
            let productPrice = document.getElementById('productPrice' + pId).value;

            document.getElementById('productBtn' + pId).textContent = 'updating...';

            axios({
                url: this.appurl + 'api/products/' + pId,
                method: 'put',
                data: {
                    productName: productName,
                    productDescription: productDescription,
                    productCategory: productCategory,
                    productPrice: productPrice,

                }
            })
                .then((response) => (
                    // this.loading = false,

                    document.getElementById('productBtn' + pId).textContent = 'done',


                    this.getProducts(),

                    console.log(response)
                    //  this.results = response.data

                )).catch(function (error) {

                    this.loading = false,



                        console.log(error);
                });


        }

    },
}
</script>
