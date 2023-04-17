
getComments(1);


function getComments(idReadingGroup){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "http://localhost:8000/api/readinggroups/comments",
        type: "POST",
        data: {idreadgroup:idReadingGroup},
        success:function(comments){
    
            document.getElementById('comments').innerHTML='';
    
            result = ``
    
            comments.forEach(comment => {
    
                result+=`<div onclick="deleteComment(`+comment.client_id+`,`+comment.id+`);" id="`+comment.id+`">`+comment.content+`</div>`
                
            });

            document.getElementById('comments').innerHTML=result;
    
        }
    })

}



function deleteComment(idClient,idComment){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "http://localhost:8000/api/readinggroups/deletecomment",
        type: "POST",
        data: {idclient:idClient,idcomment:idComment},
        success:function(){

            getComments(1)
    
        }
    })

}



function addComment(idClient,idReadingGroup){

    let content = document.getElementById('commentContent').value;

    if(content.length>0){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: "http://localhost:8000/api/readinggroups/addcomment",
            type: "POST",
            data: {idclient:idClient,idreadinggroup:idReadingGroup,content:content},
            success:function(){
    
                getComments(1);
        
            }
        })

    }

}