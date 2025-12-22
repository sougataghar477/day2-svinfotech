<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PHP App</title>
  <link rel="stylesheet" href="../styles/output.css"/>
</head>

<body>
<?php
$html = '

<div class="max-w-80 rounded-xl shadow-2xl p-4 md:p-8 w-full">
        <h1 class="font-black text-3xl">Admin Login</h1>
        <form class="w-full" onsubmit="submitAdminLogin(event)">
            <div class="w-full mt-4">
                <label for="emailfromLogin" class="block mb-1 font-bold">Email<span class="text-red-500">*</span></label>
                <input required type="text" name="email" id="emailfromLogin" class="w-full p-2 rounded-lg border-2" />
                <p class="text-red-500" id="nameErrorfromLogin"></p>
            </div>
            <div class="w-full mt-4">
                <label for="password" class="block mb-1 font-bold">Password<span class="text-red-500">*</span></label>
                <input required type="password" name="password" id="password" class="w-full p-2 rounded-lg border-2" />
                <p class="text-red-500" id="passwordError"></p>
            </div>
          <button id="submitFormBtn" type="submit" class="bg-black text-white w-full md:col-span-2  rounded-lg px-4 py-3 mt-4">Login</button>  
    </form>

</div>

';
include "../container.php";
?>
 
<script src="../scripts/main.js"></script>
</body>
</html>
