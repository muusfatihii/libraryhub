$.ajax({
    url: "http://localhost:8000/api/categories",
    type: "GET",
    success:function(data){

        document.getElementById('categories').innerHTML='';

        result = `<option value=""></option>`

        data.forEach(cat => {

            result+=`<option value="`+cat.id+`">`+cat.name+`</option>`
            
        });

        document.getElementById('categories').innerHTML=result;


    }
});


function addbook(){

    const bookName = document.getElementById('bookname');
    const category = document.getElementById('categories');


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
                    success:function(data){
                    alert(data)
                    }
                });

        });

    }else{

        alert('Le champs ne doit pas etre vide');
    }


}