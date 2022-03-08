<?php 
  if(!isset($page_title)) { $page_title = 'User Area'; }
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
  </head>

  <body class="container-fluid px-0 pt-5 vh-100">
    <nav class="navbar navbar-dark navbar-expand-sm bg-primary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="<?=url_for("/img/union-logo.svg");?>" alt="United mountains logo." width="45">Union</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Passes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Gyms</a>
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
            <span class="navbar-text pe-3">
              Hello, <?= $session->preferred_name ?>
            </span>
            <form class="d-flex" action="<?=url_for("/app/logout.php");?>">
              <button class="btn btn-outline-light" type="submit">Log Out</button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <?= display_session_message(); ?>