<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

include(SHARED_PATH . '/user-header.php'); 

$time = Attendance::find_in('10', '6');

?>

<main class="container-md p-4 mt-5" id="main">
  <p>Hello</p>
  <?= $time->id; ?>
  <?= Attendance::currently_in(6); ?>
  <?= display_errors($error_array); ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
