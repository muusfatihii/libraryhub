<template>

<ReadingGroup @showComments="showComments" @getMyReadingGroups="getMyReadingGroups" :idClient="idClient" v-for="readingGroup in readingGroups" :idRG="readingGroup.id" :name="readingGroup.name" :book="readingGroup.title" :members="readingGroup.members" />

</template>

<script>

import ReadingGroup from '../components/ReadingGroup.vue'

export default {
  name: 'ReadingGroupsPanel',
  components:{
    ReadingGroup
  },
  data (){
        return{

            readingGroups:[],

        }
    },
  props:{
    idClient:{
      type:String,
    }

  },
  created(){

    this.getMyReadingGroups(this.idClient);
   

    },
    methods:{

      getMyReadingGroups(){

        axios
          .get('http://localhost:8000/api/myreadinggroups?idclient='+this.idClient,
          {
                headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
                }
          })
          .then(response => this.readingGroups = response.data)


      },
      showComments(idreadgroup){

        this.$emit('showComments', { idreadgroup: idreadgroup })

      } 

    }

  }




</script>
