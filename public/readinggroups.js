window.onload = function() {



// --------------------------------se joindre à un groupe de lecture--------------------------
   
   const readingGrps = document.getElementsByClassName('readinggrp');


    for(let i=0;i<readingGrps.length;i++){

        readingGrps[i].addEventListener('click',(e)=>{

            let idreadinggrp = e.target.id


            let idrgrp = idreadinggrp.substring(0, idreadinggrp.length - 2);


            join(idrgrp);

        })

    }

};


function join(idreadgrp){

    if(document.getElementById('idClient')!=null){

        let text = document.getElementById('idClient').innerText

        var idClient = text.replace(/\s/g, '');

    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {
        
    
            $.ajax({
                url: "http://localhost:8000/api/readinggroups/joinrg",
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {clientid: idClient, readgrpid: idreadgrp},
                success:function(data){
                    alert(data)
                }
            });

    });



}











