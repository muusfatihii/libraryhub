<template>
    <div class="grid place-items-center space-y-10 font-mono bg-gray-900">
      <BookCard v-for="book in books" :id="book.id" :title="book.title" :cover="book.cover" :mark="book.mark" :markk="book.markk" :like="book.like"/>
    </div>
</template>

<script>
import BookCard from '../components/BookCard.vue'

export default {
  name: 'BooksCardsPanel',
  components:{
    BookCard
  },
  data (){
        return{

            books:[],

        }
    },
  props:{
    idClient:{
      type:String
    }
  },
  created(){

          axios
          .get('http://localhost:8000/api/myfavoris?idClient='+this.idClient,
          {
                headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
                }
          })
          .then(response => this.books = response.data)


    }

  }


</script>


<style scoped>

@import 'https://fonts.googleapis.com/icon?family=Material+Icons';

body {
  text-align: center;
}

.hr-text {
  line-height: 1em;
  position: relative;
  outline: 0;
  border: 0;
  color: black;
  text-align: center;
  height: 1.5em;
  opacity: 0.5;
}
.hr-text:before {
  content: "";
  background: linear-gradient(to right, transparent, #818078, transparent);
  position: absolute;
  left: 0;
  top: 50%;
  width: 100%;
  height: 1px;
}
.hr-text:after {
  content: attr(data-content);
  position: relative;
  display: inline-block;
  color: black;
  padding: 0 0.5em;
  line-height: 1.5em;
  color: #818078;
  background-color: #fcfcfa;
}

</style>