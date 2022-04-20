<footer class="mt-5 p-5 bg-primary text-light">
  <div class="row justify-content-center">
    <div class="col-auto ">
      <div class="row justify-content-center">
        <div class="col-auto">
          <img class="img-fluid" src="/public/img/union-logo-yellow.svg" alt="Union mountains logo." width="75">
        </div>
      </div>
      <div class="row row-cols-auto">
        <p class="d-inline-block h1 display-3 mb-0 col">Union</p>
      </div>
    </div>
  </div>
  <div class="row pt-4">
    <div class="col-6 col-lg-4">
      <h3>Site Menu</h3>
      <ul class="nav flex-column">
        <li class="nav-item">Home</li>
        <li class="nav-item">Passes</li>
        <li class="nav-item">Gyms</li>
        <li class="nav-item">Events</li>
        <li class="nav-item">Log In / Sign Up</li>
      </ul>
    </div>
  </div>
  <div class="row pt-4">
    <p class="text-center">&copy; <?= date('Y'); ?> Union Climbing | <a href="#">Privacy Policy</a></p>
  </div>
</footer>

<button type="button" class="btn shadow btn-secondary rounded-circle btn-lg" id="back-to-top"><i class="fas fa-arrow-up"></i></button>

<?php if(isset($scripts)) {
  foreach($scripts as $script) {
    echo('<script src="' . url_for($script) .'" defer></script>');
  }
} ?>

</body>

<?php 
  if(isset($user->error_array)) {
    echo display_errors($user->error_array);
  }
?>

</html>

<?php
  db_disconnect($database);
?>