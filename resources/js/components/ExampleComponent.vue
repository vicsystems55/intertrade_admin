<template>
    
    <div class="">

    

            <modal name="example" 
                :width="400"
                :height="500"
                
                :scrollable="true"
            >

            <div class="container py-3">

                         <h4 class="text-center">InterTrade Limited</h4>

                <div class="p-5">
                    <input type="text" class="form-control" placeholder="Search..." v-model="key" @keyup="get_account_maps()">
                </div>

                <table class="table">
                <thead>
                    <tr>
                        <th>Head</th>
                        <th>Subhead</th>
                    </tr>
                </thead>

                <tbody>

                

                    <tr v-for="map in account_maps" :key="map.id">
                        <td>{{map.heads.title}}</td>
                        <td>

                            <div class="custom-control custom-checkbox">
                            <input v-model="my_maps" v-bind:value="map.id" type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">{{map.subheads.title}}</label>
                            </div>

                        </td>

                    </tr>


                </tbody>
                    

                </table>


                <div class="form-group text-center">   

                        <button @click="create_my_voucher()" class="btn btn-primary ">Create</button>

                </div>



            </div>

       

         
         
         
         
         
         
         </modal>

         <div class="form-group text-center">

            <button class="btn btn-primary" @click="generate_voucher()">Generate Voucher</button>

         </div>

    </div>

         
   
</template>

<script>

import VModal from 'vue-js-modal'
Vue.use(VModal)
    export default {



        data() {
            return {
                account_maps: [],
                key: '',
                my_maps: [] 
            }
        },


          props: ['appurl', 'listingcode'],

        methods: {
            generate_voucher(){

                 this.$modal.show('example')
            },

            create_my_voucher(){
                alert('created');
            },

            get_account_maps(){

             

                    axios.post(this.appurl+'account_maps',{
                        key: this.key,
                        // date: this.date,
                        // file_upload: this.newfile_name,
                        // text_report: this.outputData.blocks,
                    
                    }).then((response)=>(
                    // this.loading = false,

                    this.account_maps = response.data,

                    console.log(response)
                    //  this.results = response.data

                )).catch(function (error) {
                        console.log(error);
                });

         }


        },
        mounted() {
            console.log('Component mounted.');
            this.get_account_maps();
           
        }
    }
</script>
