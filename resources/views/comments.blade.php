<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
        <script type='text/javascript' src='comments.js'></script>
    <title>Document</title>
</head>
<body>
<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div id="comments" class="w-full overflow-x-auto">
      
    </div>
    <div id="addcomment">
    <textarea id="commentContent">
    </textarea>
    <button onclick="addComment(1,1);">add comment</button>
    </div>
  </div>
</section>
    
</body>
</html>