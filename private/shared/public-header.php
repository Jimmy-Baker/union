<?php 
  if(!isset($page_title)) { $page_title = 'Visitor Area'; }
  $page = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/") + 1);
  $scripts = [];
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Union Climbing <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta name="description" content="Union Climbing">
    <meta name="author" content="Jimmy Baker">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preload" href="<?= url_for("/css/theme-min.css");?>" as="style">
    <link rel="preload" href="<?= url_for("https://use.typekit.net/fup0mom.css");?>" as="style">

    <link rel="stylesheet" href="<?= url_for("/css/theme-min.css");?>">
    <link rel="stylesheet" href="<?= url_for("/node_modules/@fortawesome/fontawesome-free/css/all.min.css");?>">
    <link rel="stylesheet" href="https://use.typekit.net/fup0mom.css">
    <link rel="stylesheet" href="<?= url_for("/css/style.css");?>">
    <script src="<?= url_for("/node_modules/jquery/dist/jquery.slim.min.js");?>" defer></script>
    <script src="<?= url_for("/node_modules/@popperjs/core/dist/umd/popper.min.js");?>" defer></script>
    <script src="<?= url_for("/node_modules/bootstrap/dist/js/bootstrap.min.js");?>" defer></script>
    <script src="<?= url_for("js/display.js");?>" defer></script>
  </head>

  <body class="container-fluid px-0 pt-5 vh-100">
    <nav class="navbar navbar-dark shadow navbar-expand-md bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand col-auto py-0" href="<?= url_for("/index.php") ?>">
          <div class="row align-items-center">
            <div class="col pe-0">
              <img src="<?=url_for("/img/union-logo-yellow.svg");?>" alt="Union mountains logo." width="45" height="29">
            </div>
            <div class="col ps-1">
              <p class="d-inline-block h2 mb-0 col">Union</p>
            </div>
          </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"><span class="visually-hidden">Toggle Menu</span></span>
        </button>
        <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" data-bs-scroll="true" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header text-white">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><span class="visually-hidden">Toggle Menu</span></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-start bg-dark flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link<?= active_class('passes') ?>" href="<?= url_for("passes.php"); ?>">Passes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?= active_class('gyms') ?>" href="<?= url_for("gyms.php"); ?>">Gyms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?= active_class('events') ?>" href="<?= url_for("events.php"); ?>">Events</a>
              </li>
            </ul>
            <form class="d-flex row pe-sm-4 pt-4 pt-sm-0 bg-dark" action="<?=url_for("/app/login.php");?>">
              <button class="col-auto btn btn-outline-light ms-2 ms-sm-0 order-sm-1" type="submit">Log In</button>
              <a class="col-sm-auto nav-link text-light order-sm-0" href="<?= url_for("/app/signup.php"); ?>">Sign Up</a>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <?= display_session_message(); ?>
