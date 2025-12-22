<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PHP App</title>
  <link rel="stylesheet" href="./styles/output.css"/>
</head>

<body>

  <h1>PHP Server Running</h1>

  <?php

// Load our environment variables from the .env file:
    
     $html='<div>Hello</div>';
     include './container.php';
  ?>

</body>
</html>
