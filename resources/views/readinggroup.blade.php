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
        <link rel="stylesheet" href="readinggroups.css">
        <script type='text/javascript' src='readinggroups.js'></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
      </head>
    <body class="antialiased">
    <!--  -->
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
      <!--  -->
        
<section class="mt-20 articles">

@forelse ($readinggroups as $readinggroup)
<article>
    <div class="article-wrapper">
      <figure>
        <img src="https://picsum.photos/id/1005/800/450" alt="" />
      </figure>
      <div class="article-body">
        <h2>{{$readinggroup->name}}</h2>
        <p>
          Curabitur convallis ac quam vitae laoreet. Nulla mauris ante, euismod sed lacus sit amet, congue bibendum eros. Etiam mattis lobortis porta. Vestibulum ultrices iaculis enim imperdiet egestas.
        </p>
        @auth
        <a id="<?=$readinggroup->id.'rg'?>" class="read-more readinggrp">
          Rejoignez <span class="sr-only">about this is some title</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </a>
        @endauth
      </div>
    </div>
  </article>
@empty
    <p>Y'a pas de groupes de lecture</p>
@endforelse

</section>

@if(isset(Auth::user()->id))
<div id="idClient" class="hidden">
{{Auth::user()->id}}
</div>
@endif
    
    </body>
</html>
