<footer class="mt-5 p-5 bg-primary text-light">
  <div class="row justify-content-center">
    <div class="col-auto ">
      <div class="row justify-content-center">
        <div class="col-auto">
          <img class="img-fluid" src="/public/img/union-logo-dark.svg" alt="Union mountains logo." width="75" height="49">
        </div>
      </div>
      <div class="row row-cols-auto">
        <h2 class="d-inline-block h1 display-3 mb-0 col">Union</h2>
      </div>
    </div>
  </div>
  <div class="row gy-4 pt-4">
    <div class="col-6 col-lg-4">
      <h3>Site Menu</h3>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="<?= url_for("/index.php") ?>" class="nav-link link-light">Home</a></li>
        <li class="nav-item"><a href="<?= url_for("/passes.php") ?>" class="nav-link link-light">Passes</a></li>
        <li class="nav-item"><a href="<?= url_for("/gyms.php") ?>" class="nav-link link-light">Gyms</a></li>
        <li class="nav-item"><a href="<?= url_for("/events.php") ?>" class="nav-link link-light">Events</a></li>
      </ul>
    </div>
    <div class="col-6 col-sm-4">
      <h3>My Account</h3>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="<?= url_for("/app/login.php") ?>" class="nav-link link-light">My Profile</a></li>
        <li class="nav-item"><a href="<?= url_for("/app/signup.php") ?>" class="nav-link link-light">My Pass</a></li>
        <li class="nav-item"><a href="<?= url_for("/app/reset.php") ?>" class="nav-link link-light">Reset Password</a></li>
      </ul>
    </div>
    <div class="col-12 col-sm-4">
      <h3>Contact Us</h3>
      <address>
        <a href="mailto:info@unionclimbing.com" class="link-secondary">info@unionclimbing.com</a>
      </address>
      <address>
        <b>Union Climbing</b><br>
        PO Box 2012<br>
        Enka, NC 28728<br>
      </address>
    </div>
  </div>
  <div class="row pt-4">
    <p class="text-center">&copy; <?= date('Y'); ?> Union Climbing | <a href="#" class="link-light">Privacy Policy</a></p>
  </div>
</footer>

<button type="button" class="btn shadow btn-secondary rounded-circle btn-lg" id="back-to-top"><span class="visually-hidden">Back to Top</span><i class="fas fa-arrow-up"></i></button>

<?php 
if(isset($scripts)) {
  foreach($scripts as $script) {
    echo('<script src="' . url_for($script) .'" defer></script>');
  }
}
if(isset($error_render)) {
  echo display_errors($error_render);
}
?>
</body>

</html>

<?php db_disconnect($database); ?>
