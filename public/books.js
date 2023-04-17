getCategories();

var ratingData = []


function filter(){

  if(document.getElementById('idClient')!=null){
    var idClient = document.getElementById('idClient').innerText
  }

  getRatingData(idClient)

    setTimeout(() => {
      if(document.getElementById('idClient')!=null){
        var idClient = document.getElementById('idClient').innerText
      }else{
        var idClient = ''
      }
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        title = document.getElementById('libelle').value
        category = document.getElementById('categories').value
        desc = document.getElementById('date').value
    
        $.ajax({
            url: "http://localhost:8000/api/books/filter",
            type: "POST",
            data:{title:title,category:category,desc:desc},
            success: function(books){
    
                document.getElementById('books').innerHTML='';
    
                result=''
    
                books.forEach(book => {
    
                result += `<div class="bg-white rounded-md bg-gray-800 shadow-lg">
                <div class="md:flex px-4 leading-none max-w-4xl">
                  <div class="flex-none ">
                   <img
                    src="./storage/covers/${book.cover}"
                    alt="pic"
                    class="h-72 w-56 rounded-md shadow-2xl transform -translate-y-4 border-4 border-gray-300 shadow-lg"
                  />           
                  </div>
        
                  <div class="flex-col text-gray-300">
           
                    <p class="pt-4 text-2xl font-bold">${book.title}</p>
                    <hr class="hr-text" data-content="">
                    <div class="text-md flex justify-between px-4 my-2">
                      <!-- categories -->
                    </div>
                    <p class="hidden md:block px-4 my-4 text-sm text-left">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    
                    <p class="flex text-md px-4 my-2">
                      Rating: ${book.mark}/10 
                    </p>`
    
                    if(idClient!=''){
                      
                      var favoris = true;
    
                      for(let i=0;i<ratingData.length;i++){
    
                        if(book.id==ratingData[i].substring(0, ratingData[i].length-3)){
    
    
                            if(ratingData[i][ratingData[i].length-2]==1){
      
                              result+=`<div class="text-xs">
                          <button type="button" id="${book.id+'f'}" onclick="addBookFav(${book.id});" class="addfav border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">ajouté</button>`
                             
                            }else{
        
                              result+=`<div class="text-xs">
                          <button type="button" id="${book.id+'f'}" onclick="addBookFav(${book.id});" class="addfav border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">favoris</button>`
        
                            }
                            
                            favoris = false;
                            break;
    
                        }
                      }
    
                      if(favoris){
      
                          result+=`<div class="text-xs">
                        <button type="button" id="${book.id+'f'}" onclick="addBookFav(${book.id});" class="addfav border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">favoris</button>`
      
                      }
    
                      result+=`<button type="button" id="${book.id+'r'}" class="readbook border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">Lire</button>
                      <button type="button" id="${book.id+'rg'}" onclick="createRG(${book.id});" class="creatergroup border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">En parler</button>
                    </div>`
    
                    }
    
                    result+=`</div>
                </div>`
    
                if(idClient!=''){
    
                  result+=`<div class="flex justify-between items-center px-4 mb-4 w-full">
                  <div class="flex">`
                  var liked = true;
                  for(let i=0;i<ratingData.length;i++){
                  if(book.id==ratingData[i].substring(0, ratingData[i].length-3)){
    
                    if(ratingData[i][ratingData[i].length-1]==1){
    
                      result+=`<i id="${book.id+'h'}" onclick="likeBook(${book.id});" class="cursor-pointer heart material-icons text-red-600">favorite</i>`
                    
                    }else{
    
                      result+=`<i id="${book.id+'h'}" onclick="alert('hhh');" class="cursor-pointer heart material-icons text-red-600">favorite_border</i>`
                    }
                    liked = false;
                    break;
    
                  }
                }
                  
                if(liked){
    
                  result+=`<i id="${book.id+'h'}" onclick="alert('hhh');" class="cursor-pointer heart material-icons text-red-600">favorite_border</i>`
                }
    
                  result+=`</div>
                  <div class="flex">`
                  var rated = true;
                  for(let i=0;i<ratingData.length;i++){
                  if(book.id==ratingData[i].substring(0, ratingData[i].length-3)){
    
                    if(ratingData[i][ratingData[i].length-3]>0){

                      for(let j=0;j<ratingData[i][ratingData[i].length-3];j++){

                        result+=`<i class="cursor-pointer star material-icons ml-2 text-yellow-600">star</i>` 


                      }
    
                    }else{
    
                      result+=`<i id="${book.id+'s1'}" onclick="rateBook('${book.id+'s1'}')" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
                    <i id="${book.id+'s2'}" onclick="rateBook('${book.id+'s2'}')" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
                    <i id="${book.id+'s3'}" onclick="rateBook('${book.id+'s3'}')" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
                    <i id="${book.id+'s4'}" onclick="rateBook('${book.id+'s4'}')" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
                    <i id="${book.id+'s5'}" onclick="rateBook('${book.id+'s5'}')" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>`
    
                    }
                    rated = false;
                    break;
    
                  }
                }
                if(rated){
                  result+=`<i id="${book.id+'s1'}" onclick="rateBook('${book.id+'s1'}');" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
                    <i id="${book.id+'s2'}" onclick="rateBook('${book.id+'s2'}');" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
                    <i id="${book.id+'s3'}" onclick="rateBook('${book.id+'s3'}');" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
                    <i id="${book.id+'s4'}" onclick="rateBook('${book.id+'s4'}');" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
                    <i id="${book.id+'s5'}" onclick="rateBook('${book.id+'s5'}');" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>`
                  }
    
    
                    result+=`</div>
                </div>`
    
    
                }
                result+=
              `</div>`
                });
    
                document.getElementById('books').innerHTML=result;
        }
    })
  }, "1000");

}

function getCategories(){

  $.ajax({
    url: "http://localhost:8000/api/categories",
    type: "GET",
    success:function(data){

        document.getElementById('categories').innerHTML='';

        result = `<option value="">All categories</option>`

        data.forEach(cat => {

            result+=`<option value="`+cat.id+`">`+cat.name+`</option>`
            
        });

        document.getElementById('categories').innerHTML=result;

    }
});

}



function getRatingData(idClient){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://localhost:8000/api/books/getratingdata",
    type: "POST",
    context: this,
    data:{idclient:idClient},
    success:function(data){

      ratingData = data;

    }
  })

}


// function updateDOM() {


//   // ------------------------------heart------------------------


//   const heart = document.getElementsByClassName('heart');

//   for(let i=0;i<heart.length;i++){

//       heart[i].addEventListener('click',(e)=>{

//           let idheart = e.target.id

//           const liked = document.getElementById(idheart);
          
//           if(liked.innerHTML=="favorite_border"){

//               liked.innerHTML="favorite";

//               like(idheart.substr(0,idheart.length - 1));

//           }else{

//               liked.innerHTML="favorite_border";

//               like(idheart.substr(0,idheart.length - 1));
//           }

//       })
//   }



// }


function likeBook(idbook){

  // ------------------------------heart------------------------


          let idheart = idbook+'h'

          const liked = document.getElementById(idheart);
          
          if(liked.innerHTML=="favorite_border"){

              liked.innerHTML="favorite";

              like(idbook);

          }else{

              liked.innerHTML="favorite_border";

              like(idbook);
          }
          
}


function rateBook(idbooknbrstars){

  let idbook = idbooknbrstars.substr(0,idbooknbrstars.length - 2)

  let nbrStars = idbooknbrstars.substr(idbooknbrstars.length - 1)
  
  for(let i=1;i<=5;i++){

      const unstarred = document.getElementById(idbooknbrstars.substring(0, idbooknbrstars.length - 1)+i);

      unstarred.innerHTML="star_outline";

  }

  for(let j=1;j<=nbrStars;j++){

      const starred = document.getElementById(idbooknbrstars.substring(0, idbooknbrstars.length - 1)+j);

      starred.innerHTML="star";

  }


  rate(idbook,nbrStars)


}


function createRG(idbook){


  if(document.getElementById(idbook+'rg').innerHTML=="En parler"){

    createreadinggroup(idbook);

  }

  document.getElementById(idbook+'rg').innerHTML = "Continuez ..."

  createreadinggroup(idbook)


}


function addBookFav(idbook){


  const clickedbtn = document.getElementById(idbook+'f');


  if(clickedbtn.innerHTML=="favoris"){
      
      clickedbtn.innerHTML = "ajouté"

      addtofav(idbook)

  }else{

      clickedbtn.innerHTML="favoris"

      addtofav(idbook)
  }


}












