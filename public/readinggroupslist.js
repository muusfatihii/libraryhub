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
