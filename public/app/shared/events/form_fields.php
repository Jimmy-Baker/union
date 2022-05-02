<?php
// prevent this code from being loaded directly
if(!isset($event)) {
  redirect_to(url_for('/staff/events/events.php'));
}

$locations = Location::find_all_locations_expanded();
$today = date('Y-m-d');

?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Event Information</legend>
  <div class="card-body">

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputStartDate" class="col-form-label">Start Date</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="event[start_date]" value="<?= html_date($event->start_date); ?>" class="form-control" id="inputStartDate" min="<?= h($today); ?>" aria-describedby="helpStartDate" required>
      </div>
      <div id="helpStartDate" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEndDate" class="col-form-label">End Date</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="event[end_date]" value="<?= html_date($event->end_date); ?>" class="form-control" id="inputEndDate" aria-describedby="helpEndDate" min="<?= h($today); ?>" required>
      </div>
      <div id="helpEndDate" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLocationID" class="col-form-label">Location ID</label>
      </div>
      <div class="col-md-7">
        <select name="event[location_id]" value="<?= h($event->location_id); ?>" class="form-select" id="inputLocationID" aria-describedby="helpLocationID" required>
          <?php if(test_access('AA')){foreach($locations as $location) { ?>
          <option value="<?= h($location->id) ?>" <?= ($event->location_id == $location->id) ? 'selected' : '' ?>><?= h($location->gym_name) . ' ' . h($location->location_name) ?></option>
          <?php }} else { ?>
          <option value="<?= h($session->location) ?>" selected><?= h($session->gym_name) . ' ' . h($session->location_name) ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="helpLocationID" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEventName" class="col-form-label">Event Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[event_name]" value="<?= h($event->event_name); ?>" class="form-control" aria-describedby="helpEventName" maxlength="32" id="inputEventName" required>
      </div>
      <div id="helpEventName" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputParticipants" class="col-form-label">Participants</label>
      </div>
      <div class="col-md-7">
        <input type="number" name="event[participants]" value="<?= h($event->participants); ?>" class="form-control" id="inputParticipants" min="0" max="999" step="1" aria-describedby="helpParticipants" required>
      </div>
      <div id="helpParticipants" class="form-text offset-md-3">Must be between 0 and 999</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCost" class="col-form-label">Cost</label>
      </div>
      <div class="col-md-7">
        <div class="input-group">
          <span class="input-group-text">$</span>
          <input type="text" name="event[cost]" value="<?= h($event->cost); ?>" class="form-control" id="inputCost" maxlength="6" default="0" inputmode="decimal" pattern="([0-9]{1,3})*[.]?[0-9]{2}" title="must follow X.XX format" aria-describedby="helpCost">
        </div>
      </div>
      <div id="helpCost" class="form-text offset-md-3">Must be between 0 and 999.99</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputURL" class="col-form-label">URL</label>
      </div>
      <div class="col-md-7">
        <input type="url" name="event[url]" value="<?= h($event->url); ?>" class="form-control" id="inputURL" maxlength="64" placeholder="https://www.example.com/event?id=1" aria-describedby="helpURL">
      </div>
      <div id="helpURL" class="form-text offset-md-3">Must begin with
        <code>http://</code> or
        <code>https://</code>
      </div>
    </div>

    <?php if(defined('exists')) { ?>
    <?php for($num = 1; $num<2; $num++) { ?>
    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputSavedImage<?= $num ?>" class="col-form-label">Image</label>
      </div>
      <div class="col-md-7">
        <?php if($event->photo_data != ''){ ?>
        <img src="<?= h($event->photo_data); ?>" class="rounded img-thumbnail mx-auto mb-2 avatar" alt="<?= h($event->event_name) ?> display picture." height="200" width="200">
        <?php } ?>
        <div class="input-group">
          <input type="text" value="<?= image_name($event->photo_data); ?>" name="image<?= $num ?>" class="form-control" id="inputSavedImage<?= $num ?>" aria-describedby="helpSavedImage<?= $num ?>" readonly>
          <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $num ?>" data-bs-image="<?= $num ?>">Add Image</button>
          <button type="button" class="btn-close align-self-center m-2" aria-label="Close" disabled></button>
        </div>
      </div>
      <div id="helpSavedImage<?= $num ?>" class="form-text offset-md-3"></div>
    </div>
    <?php include(PUBLIC_PATH . '/app/shared/upload.php'); ?>
    <?php }} ?>
  </div>
</fieldset>

<?php $scripts[] = "js/photo_modal.js" ?>