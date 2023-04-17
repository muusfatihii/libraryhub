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
        <script type='text/javascript' src='readinggroupslist.js'></script>
    <title>Document</title>
</head>
<body>

<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
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

</body>
</html>