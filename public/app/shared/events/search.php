<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');
require_login();

/** 
 * Perform a sql search query upon request
 */
if(is_post_request()) {
  $args = $_POST;
  $search = new Search($args);
  $search->table = "events";
  
  $sql = $search->getSQL();
  if($sql){
    $events = Event::find_by_sql($sql);
    if($events) {
      if(count($events) < 1){
       $session->message('No events were found. Please try again.', 'warning');
      } elseif(count($users) == 1) {
        $session->message(count($events) . ' event was found.', 'success');
      } else {
        $session->message(count($events) . ' events were found.', 'success');
      }
    } else {
      $session->message('The search query failed to return a result. Please try again.', 'warning');
    }
  } else {
    $session->message('Please check your search terms and try again.', 'warning');
  }
}

$page_title = 'Find Events';
include(SHARED_PATH . '/user-header.php'); 
?>

<header>
  <div class="p-5 bg-primary text-light">
    <div class="container-fluid py-3">
      <h1><?= $page_title ?></h1>
    </div>
  </div>
  <div class="container-md p-4">
    <div class="row justify-content-between">
      <nav aria-label="breadcrumb" class="col-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="link-primary" href="<?= $session->dashboard(); ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="link-primary" href="<?= url_for('app/shared/events/events.php'); ?>">Events</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Find Events</a></li>
        </ol>
      </nav>
      <div class="col-auto d-none d-sm-block">
        <a class="btn btn-outline-primary btn-raise dropdown-toggle" href="#" role="button" id="eventMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Event Menu
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end" aria-labelledby="eventMenuLink">
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/events.php'); ?>">All Events</a></li>
          <li><a class="dropdown-item" href="<?= url_for('app/shared/events/new.php'); ?>">New Event</a></li>
          <li><a class="dropdown-item active" href="<?= url_for('app/shared/events/search.php'); ?>">Find Events</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<main class="container-md p-4" id="main">
  <form action="<?= url_for('/app/shared/events/search.php#results'); ?>" method="POST" class="mb-5 needs-validation" novalidate>
    <fieldset class="card shadow col-md-10 mx-auto mb-4">
      <legend class="card-header">Search Criteria</legend>
      <div class="card-body">
        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4" id="query1">
          <div class="col-md-3 text-md-end">
            <label for="inputValue1" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter type for following text input" name="inputParameter1" id="inputParameter1" required>
                <option hidden value="">Select One</option>
                <option value="location_id" <?= ($_POST['inputParameter1'] ?? '') == "location_id" ? "selected" : "" ?>>Location ID</option>
                <option value="event_name" <?= ($_POST['inputParameter1'] ?? '') == "event_name" ? "selected" : "" ?>>Event Name</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue1" value="<?= $_POST['inputValue1'] ?? '';?>" aria-describedby="helpValue1" id="inputValue1" required>
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close1" disabled></button>
            </div>
          </div>
          <div id="helpValue1" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4" id="query2">
          <div class="col-md-3 text-md-end">
            <label for="inputValue2" class="col-form-label">Parameter</label>
          </div>
          <div class="col-md-7">
            <div class="row ms-0 input-group">
              <select class="form-select" aria-label="Parameter type for following text input" name="inputParameter2" id="inputParameter2">
                <option hidden value="">Select One</option>
                <option value="location_id" <?= ($_POST['inputParameter2'] ?? '') == "location_id" ? "selected" : "" ?>>Location ID</option>
                <option value="event_name" <?= ($_POST['inputParameter2'] ?? '') == "event_name" ? "selected" : "" ?>>Event Name</option>
              </select>
              <input type="text" class="form-control w-50" name="inputValue2" value="<?= $_POST['inputValue2'] ?? '';?>" aria-describedby="helpValue2" id="inputValue2">
              <button type="button" class="btn-close align-self-center m-2" aria-label="Close" id="close2"></button>
            </div>
          </div>
          <div id="helpValue2" class="form-text offset-md-3">Maximum of 32 Characters</div>
        </div>

        <div id="addParamRow" class="row mb-3 mb-md-4">
          <div class="row col-md-10 justify-content-end">
            <div class="col-auto">
              <button id="addParam" type="button" class="btn btn-outline-primary">Add A Parameter</button>
            </div>
          </div>
        </div>

      </div>
    </fieldset>

    <div class="row justify-content-evenly" role="toolbar" aria-label="Event toolbar">
      <div class="col-sm-4 col-md-3 d-grid">
        <button class="btn shadow btn-primary" type="submit">Search For Events</button>
      </div>
    </div>
  </form>

  <?php if (isset($events)) { ?>
  <hr class="w-50 mx-auto">

  <div class="card shadow mx-auto mt-5" id="results">
    <div class="card-header fs-4">Search Results</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <caption>Event Search Results</caption>
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Location ID</th>
              <th>Event Name</th>
              <th>Participants</th>
              <th>Cost</th>
              <th>URL</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($events as $event) { ?>
            <tr class="align-middle text-nowrap">
              <td><?= h($event->id) ?></td>
              <td><?= h($event->start_date) ?></td>
              <td><?= h($event->end_date) ?></td>
              <td><?= h($event->location_id) ?></td>
              <td><?= h($event->event_name) ?></td>
              <td><?= h($event->participants) ?></td>
              <td><?= h($event->cost) ?></td>
              <td><?= h($event->url) ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="event actions">
                  <a class="btn btn-primary" href="<?= url_for('/app/shared/events/view.php?id=' . u($event->id)); ?>">View</a>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span></button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-primary dropdown-menu-end text-end">
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/events/edit.php?id=' . u($event->id)); ?>">Edit</a></li>
                    <li><a class="dropdown-item" href="<?= url_for('/app/shared/events/delete.php?id=' . u($event->id)); ?>">Delete</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
</main>

<?php include(SHARED_PATH . '/user-footer.php'); ?>
