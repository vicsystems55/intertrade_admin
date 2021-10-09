<template>
    <div class="col-lg-12 mx-auto">


        <div class="row">
            <div v-for="image in images" :key="image.id" class="col-md-4 p-3">

            <div >
                          <img style="height: 230px; width: 230px; object-fit: cover; border-radius: 20px;" class="shadow" :src="getPic(image.img_path)" >
                          <button
                            @click="deletePix(image.id)"
                           type="button" class="btn btn-danger btn-sm" style="position: absolute;  margin-top: 2px; margin-left: -50px; width: 45px; height: 45px; border-radius: 50%;" >x</button>   

            </div>
            


            </div>   


        </div>

    <div class="col-md-12 mx-auto">

        <h4 class="text-center">Upload Images</h4>

    

      <VueFileAgent
            ref="vueFileAgent"
            :theme="'grid'"
            :multiple="true"
            :deletable="true"
            :meta="true"
            :accept="'image/*,.zip'"
            :maxSize="'10MB'"
            :maxFiles="14"
            :helpText="'Choose images or zip files'"
            :errorText="{
            type: 'Invalid file type. Only images or zip Allowed',
            size: 'Files should not exceed 10MB in size',
            }"
            @select="filesSelected($event)"
            @beforedelete="onBeforeDelete($event)"
            @delete="fileDeleted($event)"
            v-model="fileRecords"
            @upload="onUpload($event)"
        ></VueFileAgent>
  <button :disabled="!fileRecordsForUpload.length" class="btn btn-outline-secondary btn-block col-md-6 mx-auto text-center mt-2" @click="uploadFiles()">
    Upload {{ fileRecordsForUpload.length }} files
  </button>

    </div>

    
      
    </div>
</template>
<script>

import Vue from 'vue';
import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
import VueToastify from "vue-toastify";
Vue.use(VueToastify);



Vue.use(VueFileAgent,{
  theme: "light"
});

export default {

data(){
    return{
        categories: [],
        images: [],
        subtypes: [],
        loading: false,
        baseURL: process.env.MIX_API_URL,

        fileRecords: [],
        uploadUrl: this.appurl +'upload_pix',
        uploadHeaders: { 
            'X-Test-Header': 'vue-file-agent',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        fileRecordsForUpload: [], // maintain an upload queue

        
    }
},


    props: ['appurl', 'reportcode'],

    methods: {

            getPic(img) {
              return this.appurl +img;
            },

              get_images(){
              
                    axios.get(this.appurl+'get_images',{
                      
                        // date: this.date,
                        // file_upload: this.newfile_name,
                        // text_report: this.outputData.blocks,
                    

                    }).then((response)=>(
                    // this.loading = false,


                   

                    this.images = response.data,


                    

                    console.log(response)
                    //  this.results = response.data

                )).catch(function (error) {
                        console.log(error);
                });

      },

      deletePix(img_id){

        

        
                    axios.post(this.appurl+'delete_pix',{
                        img_id: img_id,
                        // date: this.date,
                        // file_upload: this.newfile_name,
                        // text_report: this.outputData.blocks,
                    

                    }).then((response)=>(
                    // this.loading = false,


                   console.log(response),

                    this.get_images(),

                    this.$vToastify.success({
                      body: "Picture Removed",
                      title: " ",
                      theme: "light",
                      hideProgressbar: true,
                      
                    }),


                    

                    console.log(response)
                    //  this.results = response.data

                )).catch(function (error) {
                        console.log(error);
                });
          
      },

        onUpload(responses) {

            console.log(responses[0]);

            // alert(responses[0]);

            this.get_images();

           

        //   console.log(responses[0].data);
        },
      uploadFiles: function () {
        // Using the default uploader. You may use another uploader instead.
        this.$refs.vueFileAgent.upload(this.uploadUrl, this.uploadHeaders, this.fileRecordsForUpload);
        this.fileRecordsForUpload = [];
      },
      deleteUploadedFile: function (fileRecord) {
        // Using the default uploader. You may use another uploader instead.
        this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, fileRecord);
      },
      filesSelected: function (fileRecordsNewlySelected) {
        var validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error);
        this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords);
      },
      onBeforeDelete: function (fileRecord) {
        var i = this.fileRecordsForUpload.indexOf(fileRecord);
        if (i !== -1) {
        // queued file, not yet uploaded. Just remove from the arrays
          this.fileRecordsForUpload.splice(i, 1);
          var k = this.fileRecords.indexOf(fileRecord);
          if (k !== -1) this.fileRecords.splice(k, 1);
        } else {
          if (confirm('Are you sure you want to delete?')) {
            this.$refs.vueFileAgent.deleteFileRecord(fileRecord); // will trigger 'delete' event
          }
        }
      },
      fileDeleted: function (fileRecord) {
        var i = this.fileRecordsForUpload.indexOf(fileRecord);
        if (i !== -1) {
          this.fileRecordsForUpload.splice(i, 1);
        } else {
          this.deleteUploadedFile(fileRecord);
        }
      },




    },


        mounted() {

     alert('welcome channel');

        window.Echo.channel("newTask").listen(".task-created", e => {
                  alert('yeah');
        });
             
        
        this.get_images();

         
        },

}


</script>