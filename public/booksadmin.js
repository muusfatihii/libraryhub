

getBooks();


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
    <button onclick="modifyBookName(`+idbook+`);" class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700">Modify</button>
</form>`;

    
    const node = document.createElement("tr");


    node.innerHTML = modifysection;
      
    referenceNode.parentNode.insertBefore(node, referenceNode.nextSibling);


    }
}


function modifyBookName(idbook){


    let name = document.getElementById(idbook+'nn').value;

  if(name!=''){

        $.ajax({
          url: "http://localhost:8000/api/books/"+idbook,
          type: "PUT",
          data:{name:name},
          success:function(){
              getBooks();
          }
      });

  }

}




