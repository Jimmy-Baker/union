<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

include(SHARED_PATH . '/user-header.php');

?>

<main class="container-md p-4 mt-5" id="main">
  <p>Hello</p>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Image</button>
  <img src="/upload/profile/default.png">
</main>
<?php include(PUBLIC_PATH . '/app/shared/upload.php'); ?>
<?php include(SHARED_PATH . '/user-footer.php'); ?>