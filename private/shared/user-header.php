<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
  $page = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/") + 1);
?>

<!doctype html>

<html lang="en">
  <head>
    <title>WNC Birds - <?= h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/stylesheets/normalize.css'); ?>" />
    <link rel="stylesheet" media="all" href="<?= url_for('/stylesheets/skeleton.css'); ?>" />
    <link rel="stylesheet" media="all" href="<?php
     if ($page == 'index.php' || $page == 'login.php' || $page == '') { echo url_for('/stylesheets/index.css');
     } else { echo url_for('/stylesheets/public.css');} ?>" />
  </head>
  
  <body class="container">
    <header class="row">
      <div class="twelve columns">
        <h1>
          <a>WNC Birds Staff Area</a>
        </h1>
      <div>
    </header>
    <navigation>
      <ul class ="row">
        <?php if($session->is_logged_in()) { ?>
        <li class="four columns">User: <?= $session->email; ?>
        <li class="four columns"><a href="<?= url_for('/staff/index.php'); ?>">Menu</a></li>
        <li class="four columns"><a href="<?= url_for('/staff/logout.php'); ?>">Logout</a></li>
        <?php } ?>
      </ul>
    </navigation>

    <?= display_session_message(); ?>
