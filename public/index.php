<?php require_once('../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/public-header.php'); ?>

<div id="main">
  <ul id="menu">
    <li class="row"><a
        class="button button-primary"
        href="<?= url_for('/birds.php'); ?>"
      >View Our Birds</a></li>
    <li class="row"><a
        class="button button-primary"
        href="<?= url_for('/about.php'); ?>"
      >About Us</a></li>
    <li class="row"><a
        class="button button-primary"
        href="<?= url_for('/staff/login.php'); ?>"
      >Member Log In</a></li>
  </ul>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>