<?php 
  if(!isset($page_title)) { $page_title = 'Visitor Area'; }
  $page = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/") + 1);
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Union Climbing <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta name="description" content="">
    <meta name="author" content="Jimmy Baker">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= url_for("/css/theme.css");?>">
    <link rel="stylesheet" href="<?= url_for("/node_modules/@fortawesome/fontawesome-free/css/all.min.css");?>">
    <link rel="stylesheet" href="https://use.typekit.net/fup0mom.css">
    <link rel="stylesheet" href="<?= url_for("/css/style.css");?>">
    <script src="<?= url_for("/node_modules/jquery/dist/jquery.slim.min.js");?>" defer></script>
    <script src="<?= url_for("/node_modules/@popperjs/core/dist/umd/popper.min.js");?>" defer></script>
    <script src="<?= url_for("/node_modules/bootstrap/dist/js/bootstrap.min.js");?>" defer></script>
    <script src="<?= url_for("js/display.js");?>" defer></script>
  </head>

  <body class="container-fluid px-0 pt-5 vh-100">
    <nav class="navbar navbar-dark bg-dark shadow navbar-expand-sm bg-primary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand col-auto py-0" href="<?= url_for("/index.php") ?>">
          <div class="row align-items-center">
            <div class="col pe-0">
              <img src="<?=url_for("/img/union-logo-dark.svg");?>" alt="Union mountains logo." width="45">
            </div>
            <div class="col ps-1">
              <h1 class="d-inline-block h2 mb-0 col">Union</h1>
            </div>
          </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-primary" tabindex="-1" id="offcanvasNavbar" data-bs-scroll="true" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header text-white">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav bg-dark justify-content-start flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link <?= ($page_title == 'Home') ? "active" : ''; ?>" aria-current="page" href="<?= url_for("index.php"); ?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($page_title == 'Passes') ? "active" : ''; ?>" href="<?= url_for("passes.php"); ?>">Passes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($page_title == 'Partner Gyms') ? "active" : ''; ?>" href="<?= url_for("gyms.php"); ?>">Gyms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($page_title == 'Events') ? "active" : ''; ?>" href="<?= url_for("events.php"); ?>">Events</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> -->
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