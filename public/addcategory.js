window.onload = function() {


    







};


function addcategory(){

    const catName = document.getElementById('catname');


    if(catName.value!=''){


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).ready(function () {
            
        
                $.ajax({
                    url: "http://localhost:8000/api/categories",
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {category: catName.value},
                    success:function(data){
                    alert(data)
                    }
                });

        });

    }else{

        alert('Le champs ne doit pas etre vide');
    }


}