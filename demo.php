<?php 

require_once('database-connection.php'); 
$query = "SELECT * FROM states";
$result = mysqli_query($database, $query);

?>

<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Responsive</title>
    <meta name="description" content="">
    <meta name="author" content="Jimmy Baker">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <h1>Database Connection Demo</h1>
    <h2>States</h2>
    <ul>
      <?php while($state = mysqli_fetch_assoc($result)) {?>
      <li><?=$state['state_name'].' ('.$state['abv'].')';?></li>
      <?php } ?>

      <?php mysqli_free_result($result); ?>

  </body>

</html>

<?php
  db_disconnect($database);
?>