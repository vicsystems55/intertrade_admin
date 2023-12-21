<template>
    <div class="card p-2 table-responsive">



        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Category Name</th>
                    <th> Description</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>
                <tr v-for="productCategory, key in productsCategories" :key="productCategory.id">
                    <td>{{ key + 1 }}</td>
                    <td>
                        <img style="height: 120px; width: 120px; object-fit: cover;" :src="'/'"
                            class="card-img-top" alt="...">

                    </td>

                    <td>
                        <input type="text" class="form-control form-control-sm" :id="'productCategoryName' + productCategory.id"
                            :value="productCategory.name">

                    </td>

                    <td>
                        <input type="text" class="form-control form-control-sm" :id="'productCategoryDescription' + productCategory.id"
                            :value="productCategory.description">

                    </td>




                    <td>

                        <button @click=updateCategory(productCategory.id) class="btn btn-info btn-sm"
                            :id="'productBtn' + productCategory.id">
                            Update
                        </button>
                    </td>




                </tr>
            </tbody>
        </table>

        <div class="col">
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">

                                                       <div class="form-group">
                                                        <label for="">Category Name</label>
                                                        <input v-model="newName" type="text" class="form-control" placeholder="Enter Category Name">

                                                       </div>


                                                    </div>
													<div class="modal-footer">

														<button type="button" @click="addCategory()" class="btn btn-primary">Save changes</button>
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

            newName: '',
            productsCategories: [],

            loading: false
        }
    },

    mounted() {
        console.log('Products Categories component mounted.');


        this.getProductCategories()
    },

    props: ['appurl', 'userid'],

    methods: {

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

        addCategory() {



        axios.post(this.appurl + 'api/product-category', {
            name: this.newName,
            // date: this.date,
            // file_upload: this.newfile_name,
            // text_report: this.outputData.blocks,

        }).then((response) => (
            // this.loading = false,



            alert('New Category Created'),
            this.getProductCategories()
            //  this.results = response.data

        )).catch(function (error) {
            console.log(error);
        });

        },

        async updateCategory(pId) {

            this.loading = true

            let productCategoryName = document.getElementById('productCategoryName' + pId).value;
            let productCategoryDescription = document.getElementById('productCategoryDescription' + pId).value;


            // document.getElementById('productBtn' + pId).textContent = 'updating...';

           await axios({
                url: this.appurl + 'api/product-category/' + pId,
                method: 'put',
                data: {
                    productCategoryName: productCategoryName,
                    productCategoryDescription: productCategoryDescription,


                }
            })
                .then((response) => (
                    // this.loading = false,

                    document.getElementById('productBtn' + pId).textContent = 'done',


                    // this.getProducts(),

                    console.log(response),
                    //  this.results = response.data

                    alert("Category Updated"),

                    this.getProductCategories()

                )).catch((error) => {

                    // this.loading = false,



                        console.log(error)
        });


        }

    },
}
</script>
