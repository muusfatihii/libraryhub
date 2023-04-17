getreadgroups(1);

function getreadgroups(idclient){

    $.ajax({
        url: "http://localhost:8000/api/myreadgroups",
        type: "POST",
        data:{idclient: idclient},
        success:function(myreadgroups){
    
            document.getElementById('myreadgroups').innerHTML='';
    
            result = ``
    
            myreadgroups.forEach(myreadgroup => {
    
                result+=`<tr class="text-gray-700">
                    <td class="px-4 py-3 border">
                      <div class="flex items-center text-sm">
                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <p class="font-semibold text-black">`+myreadgroup.name+`</p>
                          </div>
                        </div>
                      </td>`
                     result+=`<td onclick="modifyReadgroup(`+myreadgroup.id+`);" id="`+myreadgroup.id+`m" class="modifyReadgroup px-4 py-3 text-sm border">modify</td>
                      <td onclick="deleteReadgroup(`+myreadgroup.id+`);" id="`+myreadgroup.id+`d" class="deleteReadgroup px-4 py-3 text-sm border">delete</td>
                      </tr>`
                
            });
    
            document.getElementById('myreadgroups').innerHTML=result;
    
    
        }
    });

}

function deleteReadgroup(idreadgroup){

    $.ajax({
        url: "http://localhost:8000/api/readinggroups/"+idreadgroup,
        type: "DELETE",
        success:function(){
            getreadgroups(1);
        }
    });


}


