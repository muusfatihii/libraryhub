window.onload = function() {


    if(document.getElementById('idClient')!=null){

        let text = document.getElementById('idClient').innerText

        var idClient = text.replace(/\s/g, '');

    }

    

    //-----------------------rating section-------------------


    const star = document.getElementsByClassName('star');

    for(let i=0;i<star.length;i++){

        star[i].addEventListener('click',(e)=>{

            let idstar = e.target.id

            let nbrStars = idstar.substr(idstar.length - 1)
            
            for(let i=1;i<=5;i++){

                const unstarred = document.getElementById(idstar.substring(0, idstar.length - 1)+i);

                unstarred.innerHTML="star_outline";

            }

            for(let j=1;j<=nbrStars;j++){

                const starred = document.getElementById(idstar.substring(0, idstar.length - 1)+j);

                starred.innerHTML="star";

            }


            
            idbook='';
            i=0;
            while(idstar[i]!='s'){

                idbook+=idstar[i];

                i++;

            }

            rate(idbook,nbrStars);

        })
    }


    // ------------------------------heart------------------------


    const heart = document.getElementsByClassName('heart');

    for(let i=0;i<heart.length;i++){

        heart[i].addEventListener('click',(e)=>{

            let idheart = e.target.id

            const liked = document.getElementById(idheart);
            
            if(liked.innerHTML=="favorite_border"){

                liked.innerHTML="favorite";

                like(idheart.substr(0,idheart.length - 1));

            }else{

                liked.innerHTML="favorite_border";

                like(idheart.substr(0,idheart.length - 1));
            }
            

        })
    }


    //-------------------------------------add to my favs-------------------------------

  const addfav = document.getElementsByClassName('addfav')

  for(let i=0;i<addfav.length;i++){

    addfav[i].addEventListener('click',(e)=>{

        let id_add_book_fav = e.target.id

        const clickedbtn = document.getElementById(id_add_book_fav);


        let idbook = id_add_book_fav.substr(0,id_add_book_fav.length - 1)

        
        if(clickedbtn.innerHTML=="favoris"){
            
            clickedbtn.innerHTML = "ajouté"

            addtofav(idbook)

        }else{

            clickedbtn.innerHTML="favoris"

            addtofav(idbook)
        }
        



    })

  }



//   --------------------------------------------create reading groups------------------------------

const createReadingGroup = document.getElementsByClassName('creatergroup')



for(let i=0;i<createReadingGroup.length;i++){

    createReadingGroup[i].addEventListener('click',(e)=>{

        const idbook_rg = e.target.id;
        
        if(document.getElementById(idbook_rg).innerHTML=="En parler"){

            // alert(idbook_rg.substr(0,idbook_rg.length - 2));

            createreadinggroup(idbook_rg.substr(0,idbook_rg.length - 2));

            // alert('Groupe de lecture créé avec succès');


        }

        document.getElementById(idbook_rg).innerHTML = "Continuez ..."

    })


  }


};



  

  function rate(idbook,rate){

    let text = document.getElementById('idClient').innerText

    let idClient = text.replace(/\s/g, '')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $(document).ready(function () {
        
    
            $.ajax({
                url: "http://localhost:8000/api/books/rate",
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {clientid: idClient, bookid: idbook, mark: rate},
                success:function(data){
                  alert(data)
                }
            });

    });


    

    //   axios
    //   .post('http://localhost:8000/api/books',
    //     {
    //         user_id:1,
    //         book_id:idbook,
    //         mark:rate
    //     },
    //     {
    //         headers: {
    //             'Content-Type': 'application/x-www-form-urlencoded',
    //           }

    //     }
        
    //   );
        
  }



  function like(idbook){

    let text = document.getElementById('idClient').innerText

    let idClient = text.replace(/\s/g, '')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



     $(document).ready(function () {
        
    
            $.ajax({
                url: "http://localhost:8000/api/books/like",
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {clientid: idClient , bookid: idbook},
                success:function(data){
                  alert(data)
                }
            });

    });

        
  }



  function addtofav(idbook){

            let text = document.getElementById('idClient').innerText

            let idClient = text.replace(/\s/g, '')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $(document).ready(function () {
                
            
                    $.ajax({
                        url: "http://localhost:8000/api/books/addfav",
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {clientid: idClient , bookid: idbook},
                        success:function(data){
                        alert(data)
                        }
                    });

            });


  }



  function createreadinggroup(idbook){

        let text = document.getElementById('idClient').innerText

        let idClient = text.replace(/\s/g, '')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function () {
            
        
                $.ajax({
                    url: "http://localhost:8000/api/books/addrg",
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {clientid: idClient, bookid: idbook},
                    success:function(data){
                        alert(data)
                    }
                });

        });


  }


  




  

