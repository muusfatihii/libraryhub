<template>
    <section class="relative container mx-auto p-6 font-mono">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-sm font-bold tracking-wide text-left text-gray-900 bg-white border-b border-black">
              <th class="px-4 py-3">Nom</th>
              <th class="px-4 py-3">Livre</th>
              <th class="px-4 py-3">Members</th>
              <th class="px-4 py-3">Quitter</th>
            </tr>
          </thead>
          <tbody id="myreadgroups" class="bg-white">
            <ReadingGroupsPanell @showComments="showComments" :idClient="idClient" />
          </tbody>
        </table>
        <div id="comments" class="hidden left-0 top-60 absolute">
        <Comment @commentDeleted="getComments(idRG)" v-for="comment in comments" :id="comment.id" :content="comment.content" :idClient="idClient" />
  
        <div class="relative">
          <input
          v-model="comment"
          type="email"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          />
  
          <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
          <svg
              @click="addComment(idRG)"
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 text-gray-400 cursor-pointer"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
          >
          <path fill-rule="evenodd" clip-rule="evenodd" d="M3.3938 2.20468C3.70395 1.96828 4.12324 1.93374 4.4679 2.1162L21.4679 11.1162C21.7953 11.2895 22 11.6296 22 12C22 12.3704 21.7953 12.7105 21.4679 12.8838L4.4679 21.8838C4.12324 22.0662 3.70395 22.0317 3.3938 21.7953C3.08365 21.5589 2.93922 21.1637 3.02382 20.7831L4.97561 12L3.02382 3.21692C2.93922 2.83623 3.08365 2.44109 3.3938 2.20468ZM6.80218 13L5.44596 19.103L16.9739 13H6.80218ZM16.9739 11H6.80218L5.44596 4.89699L16.9739 11Z" fill="#000000"/>
          </svg>
          </span>
      </div>
       </div>
      </div>
    </div>
  </section>
  </template>
    
    <script>
    // @ is an alias to /src
    import ReadingGroupsPanell from '../components/ReadingGroupsPanell.vue'
    import Comment from '../components/Comment.vue'
    
    export default {
      name: 'ReadingGroupsView',
      data (){
        return{
        idClient:'',
        comment:'',
        comments: [],
        idRG: '',
        clicked: []
        }
      },
      components: {
          ReadingGroupsPanell,
          Comment
      },
      created(){
  
        let text = document.getElementById('idClient').innerText
  
        this.idClient = text.replace(/\s/g, '');
  
      },
      methods:{
  
        showComments(payload){
  
          this.idRG = payload.idreadgroup.idreadgroup
  
          if(this.clicked.includes(this.idRG)){
  
                document.getElementById('comments').classList.add('hidden')
                this.clicked = []
  
            }else{
  
            this.clicked = []
            this.clicked.push(this.idRG)
            document.getElementById('comments').classList.remove('hidden')
  
            this.getComments(this.idRG)
  
            }
  
        },
        getComments(idreadgroup){
  
  
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
  
              $.ajax({
                  url: "http://localhost:8000/api/readinggroups/comments",
                  type: "POST",
                  context: this,
                  data: {idreadgroup:idreadgroup},
                  success:function(comments){
                    
                    this.comments = comments;
                    
                  }
              })
              
        },
        addComment(idReadingGroup){
  
            if(this.comment.length>0){
  
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: "http://localhost:8000/api/readinggroups/addcomment",
                    type: "POST",
                    context: this,
                    data: {idclient:this.idClient,idreadinggroup:idReadingGroup,content:this.comment},
                    success:function(){

                      this.getComments(this.idRG)

                
                    }
                })
  
            }
  
          }
  
      }
    }
    </script>
    