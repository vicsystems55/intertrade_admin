<template>


<GmapMap ref="mapRef"
  :center="{lat:10, lng:10}"
  :zoom="7"
  map-type-id="hybrid"
  style="min-height: 500px"
>
  <GmapMarker
    :key="index"
    v-for="(m, index) in markers"
    :position="m.position"
    :clickable="true"
    :draggable="true"
    @click="center=m.position"
  />

    <GmapMarker ref="myMarker"
    :position="google && new google.maps.LatLng(11.995910, 8.550320)" />

    <GmapMarker ref="myMarker"
    :position="google && new google.maps.LatLng(11.989630, 8.534080)" />

    <GmapMarker ref="myMarker"
    :position="google && new google.maps.LatLng(7.144140, 3.243240)" />

    
</GmapMap>
         
   
</template>

<script>

import VModal from 'vue-js-modal'

import Vue from 'vue'

import * as VueGoogleMaps from 'vue2-google-maps'

import {gmapApi} from 'vue2-google-maps'



Vue.use(VModal)

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyArJU6PfFHaaDQhMFMp__tw8ICGa3MIerc',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
 
    //// If you want to set the version, you can do so:
    // v: '3.26',
  },
 
  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,
 
  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  installComponents: true,
})


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


        computed: {
                google: gmapApi
            },


        mounted() {
            
            console.log('Component mounted.');

                this.$refs.mapRef.$mapPromise.then((map) => {
                map.panTo(
                    {
                        lat: 11.995910, 
                        lng: 8.550320,
                        
                        })
                })

                this.$refs.mapRef.$mapPromise.then((map) => {
                map.panTo({lat: 11.989630, lng: 8.534080})
                })
  
           
        }
    }
</script>
