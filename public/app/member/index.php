<?php 
require_once('../../../private/initialize.php');
require_login();
include(SHARED_PATH . '/user-header.php'); 
?>

<h1>Member Area</h1>
<?= $session->access_abv ?>
