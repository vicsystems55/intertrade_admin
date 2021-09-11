<template>


      <google-map-marker
      title="String"
      label="String|Object"
      clickable="Boolean"
      draggable="Boolean"
      visible="Boolean"
      z-index="Number"
      click="Function"
      dblclick="Function"
      rightclick="Function"
      drag="Function"
      dragstart="Function"
      dragend="Function"
      mouseup="Function"
      mousedown="Function"
      mouseover="Function"
      mouseout="Function"
  />
  
         
   
</template>

<script>

import VModal from 'vue-js-modal'
import Vue from 'vue'
import VueGoogleMap from 'vuejs-google-maps'
import 'vuejs-google-maps/dist/vuejs-google-maps.css'

Vue.use(VueGoogleMap, {
    load: {
        apiKey: 'your-api-key',
        libraries: [/* rest of libraries */]
    }
})

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
   

        },
        mounted() {
            
            console.log('Component mounted.');
  
           
        }
    }
</script>
