<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

include(SHARED_PATH . '/user-header.php');


?>

<main class="container-md p-4 mt-5" id="main">
  <p>Hello</p>
  <?= random_six() ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>