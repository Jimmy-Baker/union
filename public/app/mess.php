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
    <?= strtotime('now'); ?>
    <p>Peter <?= is_valid_name('Peter'); ?></p>
    <p>Pe-ter <?= is_valid_name('Pe-ter'); ?></p>
    <p>Pe ter <?= is_valid_name('Pe ter'); ?></p>
    <p>Pe9er <?= is_valid_name('Pe0er'); ?></p>
  </body>

</html>

<?php

?>