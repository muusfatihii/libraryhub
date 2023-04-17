<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script src="dashboardadmin.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <title>Document</title>
</head>
<body>
<div class="min-h-screen flex flex-row bg-gray-100">
  <div class="flex flex-col w-56 bg-white rounded-r-3xl overflow-hidden">
    <div class="flex items-center justify-center h-20 shadow-md">
      <h1 class="text-3xl uppercase text-indigo-500">LibHub</h1>
    </div>
    <ul class="flex flex-col py-4">
      <li>
        <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
          <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class='bx bx-book-alt'></i></span>
          <span id="bookssectiont" class="sectiont text-sm font-medium">Books</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
          <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class='bx bx-category'></i></span>
          <span id="categoriessectiont" class="sectiont text-sm font-medium">Categories</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
          <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-chat"></i></span>
          <span id="readinggroupssectiont" class="sectiont text-sm font-medium">Reading Groups</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
          <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-user"></i></span>
          <span id="clientssectiont" class="sectiont text-sm font-medium">Users</span>
        </a>
      </li>
      <li>
        <a href="http://localhost:8000/logout" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
          <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-log-out"></i></span>
          <form method="POST" action="{{ route('logout') }}" class="text-sm font-medium">
                @csrf
            <button type="submit">Logout</button> 
          </form>
        </a>
      </li>
    </ul>
  </div>
  <section id="bookssection" class="container mx-auto p-6 font-mono">
  <div id="addbookformsection" class="hidden flex items-center justify-center ">
    <div class=" flex flex-col w-80 border-gray-900 rounded-lg px-4 py-2">        
        <form class="flex flex-col space-y-8" id="addBookForm">
            <input id="bookName" name="bookName" type="text" placeholder="Book Name" class="border rounded-lg py-1 px-3 mt-2  border-black ">
            <input id="bookCover" name="bookCover" type="file" class="border border-black rounded-lg py-1 px-3 mt-2">
            <select id="avlcategories" name="bookCat" class="border rounded-lg py-1 px-3 mt-2  border-black">
            </select>
            <button type="submit" class="border border-black rounded-lg py-1 font-semibold">Add</button>
            <!-- <button type="button" onclick="addbook();" class="border border-indigo-600 bg-black text-white rounded-lg py-3 font-semibold" routerLink="/dashboard">Add</button> -->
        </form>
    </div>
  </div>
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
    <div id="displayaddbooksection">
            > New Book
    </div>
      <table class="w-full">
        <thead>
          <tr class="text-sm font-bold tracking-wide text-left text-gray-900 bg-white border-b border-black">
            <th class="px-4 py-3">Nom</th>
            <th class="px-4 py-3">Note</th>
            <th class="px-4 py-3">Archiver</th>
            <th class="px-4 py-3">Modifier</th>
            <th class="px-4 py-3">Delete</th>
          </tr>
        </thead>
        <tbody id="books" class="bg-white">
        </tbody>
      </table>
    </div>
  </div>
</section>
<section id="categoriessection" class="hidden container mx-auto p-6 font-mono">
<div id="addcategoryformsection" class="hidden flex items-center justify-center ">
    <div class="flex flex-col w-80 border border-black rounded-lg px-8 py-2">
    <form class="flex flex-col space-y-8">
        <input id="catname" type="text" placeholder="Category Name" class="border bg-white rounded-lg py-1 px-3 mt-2 border-black">
        <button type="button" onclick="addcategory()" class="border border-black bg-white rounded-lg py-1 px-3 mt-2 font-semibold">Add Category</button>
    </form>
    </div>
</div>
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <div id="displayaddcategorysection">
       New Category
      </div>
      <table class="w-full">
        <thead>
          <tr class="text-sm font-bold tracking-wide text-left text-gray-900 bg-white border-b border-black">
            <th class="px-4 py-3">Catégorie</th>
            <th class="px-4 py-3">Modifier</th>
            <th class="px-4 py-3">Delete</th>
          </tr>
        </thead>
        <tbody id="categories" class="bg-white">
        </tbody>
      </table>
    </div>
  </div>
</section>
<section id="readinggroupssection" class="hidden container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-sm font-bold tracking-wide text-left bg-white border-b border-gray-600">
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Date de creation</th>
          </tr>
        </thead>
        <tbody id="readinggroups" class="bg-white">
        </tbody>
      </table>
    </div>
  </div>
</section>
<section id="clientssection" class="hidden container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-sm font-bold tracking-wide text-left bg-white uppercase border-b border-black">
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Date d'inscription</th>
          </tr>
        </thead>
        <tbody id="clients" class="bg-white">
        </tbody>
      </table>
    </div>
  </div>
</section>
</div>
</body>
</html>