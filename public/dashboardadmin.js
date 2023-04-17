var cats;
window.onload = function() {

   

    getBooks();
    getavlcategories();
    getCategories();
    getReadingGroups();
    getClients();


const addBookForm = document.querySelector('#addBookForm');
addBookForm.addEventListener("submit",handleAddBookForm);

// ------------------------display and hide add book section ------------------
const displayaddbooksection = document.getElementById('displayaddbooksection');
const addBookFormSection = document.getElementById('addbookformsection');

displayaddbooksection.addEventListener('click',()=>{

    addBookFormSection.classList.toggle('hidden');
    

});
// ------------------------------------------------------------

// ------------------------display and hide add category section ------------------
const displayaddcategorysection = document.getElementById('displayaddcategorysection');
const addCategoryFormSection = document.getElementById('addcategoryformsection');

displayaddcategorysection.addEventListener('click',()=>{

    addCategoryFormSection.classList.toggle('hidden');
    

});
// ------------------------------------------------------------

const sectionts = document.getElementsByClassName('sectiont')


for(let i=0;i<sectionts.length;i++){

    sectionts[i].addEventListener('click',function(e){


        for(let j=0;j<sectionts.length;j++){

            if(!document.getElementsByTagName('section')[j].classList.contains('hidden')){
                document.getElementsByTagName('section')[j].classList.add('hidden');
            }

        }
        
        
        let idsection = e.target.id.substr(0,(e.target.id).length-1)

        document.getElementById(idsection).classList.remove('hidden');


    })

}

}





// --------------------------------------------books section-----------------------------



function getBooks(){

    $.ajax({
        url: "http://localhost:8000/api/books",
        type: "GET",
        success:function(books){
    
            document.getElementById('books').innerHTML='';
    
            result = ``
    
            books.forEach(book => {
    
                result+=`<tr id="`+book.id+`r" class="text-gray-700">
                <td class="px-4 py-3 border">
                  <div class="flex items-center text-sm">
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                      <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                      <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                      <p class="font-semibold text-black">`+book.title+`</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-sm border">`+book.mark+`</td>`
                  if(book.archived){

                    result+=`<td onclick="unarchiveBook(`+book.id+`);" id="`+book.id+`ua" class="unarchivebook px-4 py-3 text-sm border">unarchive</td>`

                  }else{

                    result+=`<td onclick="archiveBook(`+book.id+`);" id="`+book.id+`a" class="archivebook px-4 py-3 text-sm border">archive</td>`

                  }
                 result+=`<td onclick="modifyBook(`+book.id+`);" id="`+book.id+`m" class="modifybook px-4 py-3 text-sm border">modify</td>
                  <td onclick="deleteBook(`+book.id+`);" id="`+book.id+`d" class="deletebook px-4 py-3 text-sm border">delete</td>
                  </tr>`
                
            });

            document.getElementById('books').innerHTML=result;
    
        }
    })

}





function deleteBook(idbook){


    $.ajax({
        url: "http://localhost:8000/api/books/"+idbook,
        type: "DELETE",
        success:function(){
            getBooks();
        }
    });


}


function archiveBook(idbook){



    $.ajax({
        url: "http://localhost:8000/api/books/archive",
        type: "PUT",
        data:{idbook:idbook},
        success:function(data){

            getBooks();
        }
    });


}


function unarchiveBook(idbook){



    $.ajax({
        url: "http://localhost:8000/api/books/unarchive",
        type: "PUT",
        data:{idbook:idbook},
        success:function(data){

            getBooks();
            
        }
    });


}

var clicked = [];

function modifyBook(idbook){

    const referenceNode = document.getElementById(idbook+'r');

    if(clicked.includes(idbook)){

        referenceNode.nextSibling.remove();

        clicked.pop(idbook);

    }else{

        clicked.push(idbook); 

    let modifysection = `<form class="flex flex-col bg-white rounded shadow-lg p-12 mt-12" action="">
    <input id="`+idbook+`nn" class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" type="text">
    <select id="`+idbook+`nc"><option value=""></option>`

    cats.forEach(cat => {

        modifysection+=`<option value="`+cat.id+`">`+cat.name+`</option>`
        
    });

    modifysection +=`</select><button onclick="modifyBookName(`+idbook+`);" class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700">Modify</button>
</form>`;

    
    const node = document.createElement("tr");


    node.innerHTML = modifysection;
      
    referenceNode.parentNode.insertBefore(node, referenceNode.nextSibling);


    }
}


function modifyBookName(idbook){


    let name = document.getElementById(idbook+'nn').value;

    let cat = document.getElementById(idbook+'nc').value;

  if(name!='' || cat!=''){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
          url: "http://localhost:8000/api/books/"+idbook,
          type: "PUT",
          data:{name:name,cat:cat},
          success:function(data){
             clicked = [];
              getBooks();
          }
        });

  }

}
// ----------------------------------------------------Books section end --------------



//------------------------------------------------------Categories section start-----
function getCategories(){

    $.ajax({
        url: "http://localhost:8000/api/categories",
        type: "GET",
        success:function(categories){
    
            document.getElementById('categories').innerHTML='';
    
            result = ``
    
            categories.forEach(category => {
    
                result+=`<tr class="text-gray-700">
                <td class="px-4 py-3 border">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold text-black">`+category.name+`</p>
                      </div>
                    </div>
                  </td>
                  <td onclick="modifyCat(`+category.id+`);" id="`+category.id+`m" class="modifycat flex items-center justify-center px-4 py-3 text-sm border">modify</td>
                  <td onclick="deleteCat(`+category.id+`);" id="`+category.id+`d" class="deletecat px-4 py-3 text-sm border">delete</td>
                  </tr>`
                
            });

            document.getElementById('categories').innerHTML=result;
    
        }
    })

}


function deleteCat(idcat){


    $.ajax({
        url: "http://localhost:8000/api/categories/"+idcat,
        type: "DELETE",
        success:function(){
            getCategories();
        }
    });


}

function modifyCat(idCat){

let modifysection = `<input id="`+idCat+`nn" type="text" ><button onclick="modifyCatName(`+idCat+`);" type="button">Modify</button>`;

const referenceNode = document.getElementById(idCat+'m');
const node = document.createElement("div");

node.innerHTML=modifysection;
  
referenceNode.parentNode.insertBefore(node, referenceNode.nextSibling);

referenceNode.classList.add("hidden");

}


function modifyCatName(idCat){

  let name = document.getElementById(idCat+'nn').value;

  if(name!=''){

        $.ajax({
          url: "http://localhost:8000/api/categories/"+idCat,
          type: "PUT",
          data:{name:name},
          success:function(){
              getCategories();
          }
      });

  }else{

    getCategories();

  }

}

//-----------------------------------------categories section end ---------------------

//------------------------------------------add book start----------------------------------

function getavlcategories(){

    $.ajax({
        url: "http://localhost:8000/api/categories",
        type: "GET",
        success:function(data){

            cats = data;
    
            document.getElementById('avlcategories').innerHTML='';
    
            result = `<option value=""></option>`
    
            data.forEach(cat => {
    
                result+=`<option value="`+cat.id+`">`+cat.name+`</option>`
                
            });
    
            document.getElementById('avlcategories').innerHTML=result;
    
    
        }
    });

}


function addbook(){

    const bookName = document.getElementById('bookname');
    const category = document.getElementById('avlcategories');


    if(bookName.value!='' && category.value!=''){


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).ready(function () {
            
                $.ajax({
                    url: "http://localhost:8000/api/books",
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {bookName: bookName.value, category: category.value},
                    success:function(){
                      getBooks();
                    }
                });

        });

    }else{

        alert('Le champs ne doit pas etre vide');
    }


}


const handleAddBookForm = function(e){

    e.preventDefault()

    const Data = new FormData(this)

    // var imgFile = $("#bookCover")[0]; 
    // Data.append("bookCover", imgFile.files[0]);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "http://localhost:8000/api/books",
        type: "POST",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: Data,
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            alert(data);
        }
    });


}






//------------------------------------------add book end----------------------------------


//------------------------------------------add category start----------------------------------


function addcategory(){

    const catName = document.getElementById('catname');


    if(catName.value!=''){


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



                $.ajax({
                    url: "http://localhost:8000/api/categories",
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {category: catName.value},
                    success:function(){
                    getavlcategories();
                    getCategories();
                    }
                });


    }else{

        alert('Le champs ne doit pas etre vide');
    }


}


//------------------------------------------add category end----------------------------------

//-----------------------------------------Reading groups section start---------------

function getReadingGroups(){
$.ajax({
    url: "http://localhost:8000/api/readinggroups",
    type: "GET",
    success:function(readinggroups){

        document.getElementById('readinggroups').innerHTML='';

        result = ``

        readinggroups.forEach(readinggroup => {

            result+=`<tr class="text-gray-700">
            <td class="px-4 py-3 border">
              <div class="flex items-center text-sm">
                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                  <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                  <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                </div>
                <div>
                  <p class="font-semibold text-black">`+readinggroup.name+`</p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-3 text-xs border">
                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Acceptable </span>
              </td>
              <td class="px-4 py-3 text-sm border">`+readinggroup.created_at+`</td>
              </tr>`
            
        });

        document.getElementById('readinggroups').innerHTML=result;


    }
});
}
//-----------------------------------------Reading groups section end---------------

//-----------------------------------------Clients section start---------------------

function getClients(){

    $.ajax({
        url: "http://localhost:8000/api/clients",
        type: "GET",
        success:function(clients){
    
            document.getElementById('clients').innerHTML='';
    
            result = ``
    
            clients.forEach(client => {
    
                result+=`<tr class="text-gray-700">
                <td class="px-4 py-3 border">
                  <div class="flex items-center text-sm">
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                      <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                      <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                      <p class="font-semibold text-black">`+client.name+`</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-xs border">
                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Acceptable </span>
                  </td>
                  <td class="px-4 py-3 text-sm border">`+client.created_at+`</td>
                  </tr>`
                
            });
    
            document.getElementById('clients').innerHTML=result;
    
    
        }
    });
    
}


