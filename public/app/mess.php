<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Responsive</title>
    <meta name="description" content="">
    <meta name="author" content="Jimmy Baker">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <?php 
      $location = Permission::find_locations_by_user_permission(31, 'XC');
      var_dump($location);
      
      
    ?>
  </body>

</html>

<?php

?>