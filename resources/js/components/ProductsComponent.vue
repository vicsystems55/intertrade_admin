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
                    <th>Price (N)</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>
                <tr v-for="product, key in products" :key="product.id">
                    <td>{{ key + 1 }}</td>
                    <td>
                        <!-- <img style="height: 120px; width: 120px; object-fit: cover;" :src="product.featured_image"
                            class="card-img-top border" alt="..."> -->

                        <img v-if="product.featured_image" :id="product.id+'previewImg'"
                            @click="selectImage(key)"
                            style="height: 100px; width: 100px; object-fit: cover; " class="shadow"
                            :src="product.featured_image">

                        <img v-else :id="product.id+'previewImg'" @click="selectImage(key)"
                            style="height: 100px; width: 100px; object-fit: cover; " class="shadow"
                            :src="'https://www.lifewire.com/thmb/8MhWKwi4GEGiYRT6P56TBvyrkYA=/1326x1326/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg'">

                        <div class="text-center d-none">
                            <input :id="key+'customFile'" ref="file" :data-productid="product.id" type="file" @change="previewFile4">



                        </div>
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
                        <select :id="'productCategory' + product.id" class="form-control form-control-sm">

                            <option v-for="productCategory in productsCategories" :key="productCategory.id"
                                :value="productCategory.id"
                                :selected="product.product_category_id == productCategory.id ? true : false">

                                {{ productCategory.name }}

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

            loading: false,

            selected_product_img: '',
            selected_product_id: '',
        }
    },

    mounted() {
        console.log('Products component mounted.');

        this.getProducts()

        this.getProductCategories()
    },

    props: ['appurl', 'userid'],

    methods: {

        selectImage(key){

           (document.getElementById(key+'customFile')).click()

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

        previewFile4(event) {
            // return console.log(event.target.dataset);




            if (event.target.files.length > 0) {
                const src = URL.createObjectURL(event.target.files[0])
                const preview = document.getElementById(event.target.dataset.productid+'previewImg')
                preview.src = src
                // preview.style.display = "block";
            }

            this.selected_product_img = event.target.files[0]

            const formData = new FormData()
            formData.append('selected_product_img', this.selected_product_img)
            formData.append('selected_product_id', event.target.dataset.productid)



            axios({
                url: this.appurl + 'api/update-product-image',
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: `Bearer ${localStorage.getItem('token')}`,

                },
                method: 'post',
                data: formData,
            }).then(res => {
                this.loadingy = false
                console.log(res)

            }).catch(error => {
                this.loadingy = false

                console.log(error)
            })
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

        async updateProduct(pId) {

            this.loading = true

            let productName = document.getElementById('productName' + pId).value;
            let productDescription = document.getElementById('productDescription' + pId).value;
            let productCategory = document.getElementById('productCategory' + pId).value;
            let productPrice = document.getElementById('productPrice' + pId).value;

            document.getElementById('productBtn' + pId).textContent = 'updating...';

            await axios({
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


                    // this.getProducts(),

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
