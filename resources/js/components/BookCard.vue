<template>
<div class="bg-white rounded-md bg-gray-800 shadow-lg">
        <div class="md:flex px-4 leading-none max-w-4xl">
          <div class="flex-none ">
           <img
            :src="picurl"
            alt="pic"
            class="h-72 w-56 rounded-md shadow-2xl transform -translate-y-4 border-4 border-gray-300 shadow-lg"
          />           
          </div>

          <div class="flex-col text-gray-300">
   
            <p class="pt-4 text-2xl font-bold">{{ title }}</p>
            <hr class="hr-text" data-content="">
            <div class="text-md flex justify-between px-4 my-2">
              <!-- <span v-for="category in categories" class="font-bold">{{category.name}}</span>
              <span class="font-bold"></span> -->
            </div>
            <p class="hidden md:block px-4 my-4 text-sm text-left">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            
            <p class="flex text-md px-4 my-2">
              Rating: {{mark}}/5
            </p>
            
            <div class="text-xs">
              <button type="button" class="border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">Lire</button>
            </div>
<!--             <p>ICON BTNS</p> -->
          
          </div>
        </div>
        <div class="flex justify-between items-center px-4 mb-4 w-full">
          <div class="flex">
          <i v-if="like" class="material-icons mr-2 text-red-600">favorite</i>
          <i v-if="!like" class="material-icons text-red-600">favorite_border</i>
          </div>
          <div class="flex">
            <star v-for="i in markk"/>
          </div>
        </div>          
      </div>
</template>


<script>
import star from '../components/star.vue'
export default {
  name: 'BookCard',
  components:{
    star,
  },
  props:{
    title:{
        type:String
    },
    id:{
        type:Number
    },
    cover:{
      type:String
    },
    mark:{
        type:Number
    },
    markk:{
        type:Number
    },
    like:{
        type:Boolean
    }
  },
  computed: {
        picurl() {
            return './storage/covers/' + this.cover
        }
    }
}
</script>


<style>
</style>