
getCategories();


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
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                      <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                      <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                      <p class="font-semibold text-black">`+category.name+`</p>
                      </div>
                    </div>
                  </td>
                  <td onclick="modifyCat(`+category.id+`);" id="`+category.id+`m" class="modifycat px-4 py-3 text-sm border">modify</td>
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
