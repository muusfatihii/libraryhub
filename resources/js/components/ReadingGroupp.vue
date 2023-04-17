<template>
    <tr class="text-gray-700">
      <td class="px-4 py-3 border">
        <div class="flex items-center text-sm">
          <div class="relative w-8 h-8 mr-3 rounded-full md:block">
            <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
          </div>
          <div v-on:click="showComments(idRG)" class="cursor-pointer">
            <p class="font-semibold text-black">{{name}}</p>
          </div>
          </div>
        </td>
        <td class="px-4 py-3 text-sm border">{{book}}</td>
        <td class="px-4 py-3 text-sm border">{{ members }}</td>
        <td v-on:click="quitterReadgroup(idRG)" class="deleteReadgroup cursor-pointer px-4 py-3 text-sm border">quitter</td>
    </tr>
    </template>
    
    
    <script>
    export default {
      name: 'ReadingGroupp',
      data: function(){
        return {
        
        }
    
      },
      props:{
        idClient:{
          type:String,
        },
        idRG:{
            type:Number
        },
        name:{
            type:String
        },
        book:{
            type:String
        },
        members:{
            type:Number
        }
      },
      methods:{
    
        quitterReadgroup(idreadgroup){
    
            $.ajax({
                url: "http://localhost:8000/api/readinggroups/quitter",
                type: "DELETE",
                data: {idreadgroup:idreadgroup,idclient:this.idClient},
                success:function(){
                  
                }
            });
            
            this.$emit('getMyReadingGroups')
    
       },
       showComments(idreadgroup){
    
    
        this.$emit('showComments', { idreadgroup: idreadgroup })
    
       }
       
       
    }
    
    }
    </script>
    
          
     
    