<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>LibHub</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="bookspanel.css">
        <script type='text/javascript' src='bookspanel.js'></script>
        <script type='text/javascript' src='books.js'></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      </head>
    <body class="antialiased">
    <div class="bg-white shadow">
        <div class="container mx-auto px-4">
          <div class="flex items-center justify-between py-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>

            <div class="hidden sm:flex sm:items-center">
              <a href="{{ route('home') }}" class="text-gray-800 text-sm font-semibold mr-4">Home</a>
              <a href="{{ route('books') }}" class="text-gray-800 text-sm font-semibold mr-4">Livres</a>
              <a href="{{ route('readinggroups') }}" class="text-gray-800 text-sm font-semibold mr-4">Groupes de lecture</a>
            </div>

            <div class="hidden sm:flex sm:items-center">

                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-800 text-sm font-semibold mr-4">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-800 text-sm font-semibold mr-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-800 text-sm font-semibold border px-4 py-1 rounded-lg">Register</a>
                            @endif
                        @endauth

            </div>

            <div class="sm:hidden cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12.9499909,17 C12.7183558,18.1411202 11.709479,19 10.5,19 C9.29052104,19 8.28164422,18.1411202 8.05000906,17 L3.5,17 C3.22385763,17 3,16.7761424 3,16.5 C3,16.2238576 3.22385763,16 3.5,16 L8.05000906,16 C8.28164422,14.8588798 9.29052104,14 10.5,14 C11.709479,14 12.7183558,14.8588798 12.9499909,16 L20.5,16 C20.7761424,16 21,16.2238576 21,16.5 C21,16.7761424 20.7761424,17 20.5,17 L12.9499909,17 Z M18.9499909,12 C18.7183558,13.1411202 17.709479,14 16.5,14 C15.290521,14 14.2816442,13.1411202 14.0500091,12 L3.5,12 C3.22385763,12 3,11.7761424 3,11.5 C3,11.2238576 3.22385763,11 3.5,11 L14.0500091,11 C14.2816442,9.85887984 15.290521,9 16.5,9 C17.709479,9 18.7183558,9.85887984 18.9499909,11 L20.5,11 C20.7761424,11 21,11.2238576 21,11.5 C21,11.7761424 20.7761424,12 20.5,12 L18.9499909,12 Z M9.94999094,7 C9.71835578,8.14112016 8.70947896,9 7.5,9 C6.29052104,9 5.28164422,8.14112016 5.05000906,7 L3.5,7 C3.22385763,7 3,6.77614237 3,6.5 C3,6.22385763 3.22385763,6 3.5,6 L5.05000906,6 C5.28164422,4.85887984 6.29052104,4 7.5,4 C8.70947896,4 9.71835578,4.85887984 9.94999094,6 L20.5,6 C20.7761424,6 21,6.22385763 21,6.5 C21,6.77614237 20.7761424,7 20.5,7 L9.94999094,7 Z M7.5,8 C8.32842712,8 9,7.32842712 9,6.5 C9,5.67157288 8.32842712,5 7.5,5 C6.67157288,5 6,5.67157288 6,6.5 C6,7.32842712 6.67157288,8 7.5,8 Z M16.5,13 C17.3284271,13 18,12.3284271 18,11.5 C18,10.6715729 17.3284271,10 16.5,10 C15.6715729,10 15,10.6715729 15,11.5 C15,12.3284271 15.6715729,13 16.5,13 Z M10.5,18 C11.3284271,18 12,17.3284271 12,16.5 C12,15.6715729 11.3284271,15 10.5,15 C9.67157288,15 9,15.6715729 9,16.5 C9,17.3284271 9.67157288,18 10.5,18 Z"/>
              </svg>
            </div>
          </div>
          
          <div class="block sm:hidden bg-white border-t-2 py-2">
            <div class="flex flex-col">
              <a href="#" class="text-gray-800 text-sm font-semibold mb-1">Home</a>
              <a href="#" class="text-gray-800 text-sm font-semibold mb-1">Livres</a>
              <a href="#" class="text-gray-800 text-sm font-semibold mb-1">Groupes de lecture</a>
            <div class="flex justify-between items-center border-t-2 pt-2">

              
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-800 text-sm font-semibold mr-4">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-800 text-sm font-semibold mr-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-800 text-sm font-semibold border px-4 py-1 rounded-lg">Register</a>
                            @endif
                        @endauth
                
              </div>
            </div>
          </div>
        </div>
      </div>
       
      <!-- filter -->

        <div class="flex justify-center items-center p-6 space-x-6 bg-white rounded-xl shadow-lg">
          <div class="flex bg-gray-100 p-4 w-45 space-x-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input id="libelle" class="bg-gray-100 outline-none" type="text" placeholder="keyword" />
          </div>

          <select id="categories" class="py-3 px-2 rounded-lg text-gray-500 font-semibold cursor-pointer">
          </select>
          <select id="date" class="py-3 px-2 rounded-lg text-gray-500 font-semibold cursor-pointer">
            <option value="">Asc</option>
            <option value="1">Desc</option>
          </select>
          <div onclick="filter();" class="bg-red-600 py-3 px-5 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
            <span>Search</span>
          </div>
        </div>

      <!-- end -->

      <div id="books" class="min-h-screen grid space-y-10 pt-10 place-items-center font-mono bg-gray-900">
      
      
      @forelse ($books as $book)
      <div class="bg-white rounded-md bg-gray-800 shadow-lg">
        <div class="md:flex px-4 leading-none max-w-4xl">
          <div class="flex-none ">
           <img
            src="<?="./storage/covers/".$book->cover?>"
            alt="pic"
            class="h-72 w-56 rounded-md shadow-2xl transform -translate-y-4 border-4 border-gray-300 shadow-lg"
          />           
          </div>

          <div class="flex-col text-gray-300">
   
            <p class="pt-4 text-2xl font-bold">{{$book->title}}</p>
            <hr class="hr-text" data-content="">
            <div class="text-md flex justify-between px-4 my-2">
              <!-- categories -->
            </div>
            <p class="hidden md:block px-4 my-4 text-sm text-left">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            
            <p class="flex text-md px-4 my-2">
              Rating: {{$book->mark}}/5 
            </p>
            
            @auth

            <div class="text-xs">
            <?php $notrated = true?>
            @foreach($rats as $rat)
            
            @if($rat->book_id==$book->id)

              <?php $notrated = false?>

              @if($rat->favourite==0)
                <button type="button" id="<?=$book->id.'f'?>" class="addfav border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">favoris</button>
              @else
              <button type="button" id="<?=$book->id.'f'?>" class="addfav border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">ajouté</button>
              @endif
              
              @break
            
            @endif

            @endforeach

            @if($notrated)

            <button type="button" id="<?=$book->id.'f'?>" class="addfav border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">favoris</button>

            @endif

              <button type="button" id="<?=$book->id.'r'?>" class="readbook border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">Lire</button>
              <button type="button" id="<?=$book->id.'rg'?>" class="creatergroup border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">En parler</button>
            </div>

            @endauth
          
          </div>
        </div>
        @auth

        <div class="flex justify-between items-center px-4 mb-4 w-full">
          <div class="flex">
          <?php $notaddedfav = true?>
          @foreach($rats as $rat)

          @if($rat->book_id==$book->id)
            <?php $notaddedfav = false?>
            @if($rat->like==0)
            <i id="<?=$book->id.'h'?>" class="cursor-pointer heart material-icons text-red-600">favorite_border</i>
            @else
            <i id="<?=$book->id.'h'?>" class="cursor-pointer heart material-icons text-red-600">favorite</i>
            @endif
            @break

          @endif

          @endforeach
          @if($notaddedfav)

          <i id="<?=$book->id.'h'?>" class="cursor-pointer heart material-icons text-red-600">favorite_border</i>

          @endif

         </div>
          <div class="flex">
          <?php $notrated = true?>
          @foreach($rats as $rat)

          @if($rat->book_id==$book->id)
             <?php $notrated = false?>
            @if($rat->mark==0)
              <i id="<?=$book->id.'s1'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
              <i id="<?=$book->id.'s2'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
              <i id="<?=$book->id.'s3'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
              <i id="<?=$book->id.'s4'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
              <i id="<?=$book->id.'s5'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
            @else
              @for ($i = 0; $i < $rat->mark; $i++)
                <i class="cursor-pointer material-icons ml-2 text-yellow-600">star</i> 
              @endfor
            @endif
            @break

          @endif

          @endforeach

          @if($notrated)

              <i id="<?=$book->id.'s1'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
              <i id="<?=$book->id.'s2'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i> 
              <i id="<?=$book->id.'s3'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
              <i id="<?=$book->id.'s4'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>
              <i id="<?=$book->id.'s5'?>" class="cursor-pointer star material-icons ml-2 text-yellow-600">star_outline</i>

          @endif

          </div>
        </div> 

        @endauth         
      </div>

      @empty

      <p>Y'a pas de Livres</p>

      @endforelse

    </div>


    @auth
    <div id="idClient" class="hidden">{{Auth::user()->id}}</div>
    @endauth
      
    </body>
</html>
