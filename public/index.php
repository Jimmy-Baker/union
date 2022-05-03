<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
$page_title = 'Home';
if($session->is_logged_in()){
  include(SHARED_PATH . '/user-header.php');
} else {
  include(SHARED_PATH . '/public-header.php');
}
?>

<header>
  <div class="p-5 bg-primary text-light" id="index-hd">
    <div class="container-fluid py-3">
      <div class="row">
        <div class="col-12 col-sm-8">
          <h1 class="display-2">Freedom to Climb</h1>
        </div>
        <div class="col-8">
          <p>Unlock climbing access accross the country with the largest network of independently-owned gyms. Introducing the Union Pass, available now!</p>
          <a class="btn btn-secondary" href="<?= url_for('passes.php');?>" role="button">Explore Passes</a>
        </div>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <section class="pt-4">
    <div class="row">
      <div class="col-xl-3">
        <h2 class="text-dark text-xl-end s-heading">How it Works</h2>
        <hr class="d-none d-xl-block hr-dark mt-0 pb-1">
      </div>
      <div class="col-xl-9 px-5 px-sm-2">
        <div class="row g-4 justify-content-center">

          <div class="col-12 col-sm-6 col-lg-4 position-relative">
            <div class="card shadow border-primary h-100 p-4 py-sm-2">
              <div class="card-body">
                <div class="row">
                  <div class="card-icon mb-2">
                    <img src="/public/img/home-gym.png" width="725" height="513" alt="A home gym.">
                  </div>
                  <h3 class="text-center">Your Gym</h3>
                  <hr class="hr-primary mx-auto w-75">
                  <p>Your home gym gives you access to their facilities whenever you want. Your membership keeps you climbing day after day.</p>
                </div>
              </div>
            </div>
            <div class="connect"><span class="h1">+</span></div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 position-relative">
            <div class="card shadow border-primary h-100 p-4 py-sm-2">
              <div class="card-body">
                <div class="row">
                  <div class="card-icon mb-2">
                    <img src="/public/img/union-logo-dark.png" width="493" height="324" alt="A home gym.">
                  </div>
                  <h3 class="text-center">Union</h3>
                  <hr class="hr-primary mx-auto w-75">
                  <p>A Union Pass gives you access to all the other gyms in the Union network.</p>
                </div>
              </div>
            </div>
            <div class="connect"><span class="h1">=</span></div>
          </div>

          <div class="col-12 col-sm-10 col-lg-5 py-5 py-lg-0">
            <div class="card shadow border-primary h-100 p-4 py-sm-2">
              <div class="card-body">
                <div class="row">
                  <div class="card-icon mb-2">
                    <img src="/public/img/all-gyms.png" width="1531" height="514" alt="All union gyms.">
                  </div>
                  <h3 class="text-center">Freedom</h3>
                  <hr class="hr-primary mx-auto w-75">
                  <p>You climb where you want, when you want. No need to purchase a day pass or bum a guest pass from a friend.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="offset-xl-3 col-xl-9 px-5 px-sm-2 py-3">
        <div class="row justify-content-center">
          <p class="h1 display-1 text-dark text-center">Earn your Freedom</p>
          <p class="lead text-center">Ditch the day pass and climb like you belong.</p>
          <p>Climbers roam. From Yosemite to the Gunks, in Sprinters and on foot, travel is part of the adventure. But there was always one item that wouldn't fit in your day pack - your gym membership. That ends with Union.</p>
          <p>Union Passes extend your membership privileges from your home gym to the one you just walked into. Pay for a pass at home with your dues and never worry about getting rained out at the crag again. Each gym in the network offers access to their facilities without needing to purchase an additional day pass.</p>
          <div class="col-auto">
            <a class="btn btn-primary" href="<?= url_for("/gyms.php") ?>">Explore Gyms</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include(SHARED_PATH . '/public-footer.php'); ?>