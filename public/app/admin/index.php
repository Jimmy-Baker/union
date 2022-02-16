<?php 
require_once('../../../private/initialize.php');
require_login();
include(SHARED_PATH . '/user-header.php'); 
?>

<header class="p-5 bg-dark text-light">
  <h1>Admin Area</h1>
</header>

<main class="container-md p-4" id="main">
  <section>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <div class="col">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
          <div class="card-body text-end pt-0">
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
          <div class="card-body text-end pt-0">
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col">Card</div>
      <div class="col">Card</div>
      <div class="col">Card</div>
      <div class="col">Card</div>

    </div>
  </section>



</main>
