<template>

    <ReadingGroupp @showComments="showComments" @getMyReadingGroups="getMyReadingGroups" :idClient="idClient" v-for="readingGroup in readingGroups" :idRG="readingGroup.id" :name="readingGroup.name" :book="readingGroup.title" :members="readingGroup.members" />
    
</template>
    
<script>
    
    import ReadingGroupp from '../components/ReadingGroupp.vue'
    
    export default {
      name: 'ReadingGroupsPanell',
      components:{
        ReadingGroupp
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
    
        this.getMyReadingGroups();
       
    
        },
        methods:{
    
           getMyReadingGroups(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: "http://localhost:8000/api/readinggroupss",
                type: "POST",
                context: this,
                data: {idclient:this.idClient},
                success:function(readinggroups){

                  this.readingGroups = readinggroups

                }

            });

          },
          showComments(idreadgroup){
    
            this.$emit('showComments', { idreadgroup: idreadgroup })
    
          } 
    
        }
    
      }
    
    
    
    
</script>
    