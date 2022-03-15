<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php'); ?>

<?php require_login(); ?>


<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/user-header.php'); ?>

<div id="main">
  <ul id="menu">
    <li class="row"><a class="button button-primary" href="<?= url_for('/staff/birds/birds.php'); ?>">Edit Birds</a></li>
    <?php if($session->user_level == 'a') {
      echo '<li class="row"><a class="button button-primary" href="';
      echo url_for('/staff/app/users.php');
      echo '">Edit Users</a></li>';
      }   
    ?>
  </ul>

</div>

<?php include(SHARED_PATH . '/user-footer.php'); ?>