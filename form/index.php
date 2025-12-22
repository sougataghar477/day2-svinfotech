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
 

 
    // Define the form HTML with user data pre-filled
    $html = '
 
   <div class="shadow-2xl p-4 md:p-8 rounded-xl w-full">
   <h1 class="text-3xl font-black mb-4">User Feedback</h1>
    <form 
        method="POST" 
        onsubmit="submitMessage(event)" 
        class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="w-full">
            <label for="full_name" class="block mb-1 font-bold">Full Name<span class="text-red-500">*</span></label>
            <input required type="text" name="full_name" id="full_name" class="w-full p-2 rounded-lg border-2" />
            <p class="text-red-500" id="nameError"></p>
            </div>

        <div class="w-full">
            <label for="email" class="block mb-1 font-bold">Email<span class="text-red-500">*</span></label>
            <input required type="email" name="email" id="email"  class="w-full p-2 rounded-lg border-2" />
            <p class="text-red-500" id="emailError"></p>
            </div>

        <div class="w-full md:col-span-2">
            <label for="subject" class="block mb-1 font-bold">Subject<span class="text-red-500">*</span></label>
            <input required type="text" name="subject" id="subject" class="w-full p-2 rounded-lg border-2" />
            <p class="text-red-500" id="subjectError"></p>
        </div>

        <div class="md:col-span-2 w-full">
            <label for="message" class="block mb-1 font-bold">Message<span class="text-red-500">*</span></label>
            <textarea required name="message" minlength="20" id="message" class="w-full p-2 rounded-lg border-2"></textarea>
            <p class="text-red-500" id="messageError"></p>
        </div>

        <button id="submitFormBtn" type="submit" class="bg-black text-white w-full md:col-span-2  rounded-lg p-4">Submit</button>
    </form>
    
    </div>
    ';

    include '../container.php';
 
?>
 
<script src="../scripts/main.js"></script>
</body>
</html>
