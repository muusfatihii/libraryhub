<template>
  <BooksCardsPanel :idClient="idClient" />
</template>

<script>
// @ is an alias to /src
import BooksCardsPanel from '../components/BooksCardsPanel.vue'

export default {
  name: 'FavorisView',
  components: {
    BooksCardsPanel
  },
  data(){
    return{
      idClient:''
    }
  },
  created(){

    let text = document.getElementById('idClient').innerText

    this.idClient = text.replace(/\s/g, '');

  }
}
</script>
