<?php
// prevent this code from being loaded directly
if(!isset($event)) {
  redirect_to(url_for('/staff/events/events.php'));
}

$locations = Location::array_all_both_names();
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
        <input type="date" name="event[start_date]" value="<?= h(html_date($event->start_date)); ?>" class="form-control" id="inputStartDate" min="<?= $today; ?>" aria-describedby="helpStartDate" required>
      </div>
      <div id="helpStartDate" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEndDate" class="col-form-label">End Date</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="event[end_date]" value="<?= h(html_date($event->end_date)); ?>" class="form-control" id="inputEndDate" aria-describedby="helpEndDate" min="<?= $today; ?>" required>
      </div>
      <div id="helpEndDate" class="form-text offset-md-3"></div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLocationID" class="col-form-label">Location ID</label>
      </div>
      <div class="col-md-7">
        <select name="event[location_id]" value="<?= h($event->location_id); ?>" class="form-select" id="inputLocationID" aria-describedby="helpLocationID" required>
          <?php foreach($locations as $location) { ?>
          <option value="<?= $location['id'] ?>" <?= ($event->location_id == $location['id']) ? 'selected' : '' ?>><?= $location['gym_name'] . ' ' . $location['location_name'] ?></option>
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
        <input type="number" name="event[participants]" value="<?= h($event->participants); ?>" class="form-control" id="inputParticipants" min="0" max="999" aria-describedby="helpParticipants" required>
      </div>
      <div id="helpParticipants" class="form-text offset-md-3">Must be between 0 and 999</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCost" class="col-form-label">Cost</label>
      </div>
      <div class="col-md-7">
        <input type="number" name="event[cost]" value="<?= h($event->cost); ?>" class="form-control" id="inputCost" min="0" max="999.99" step=".01" aria-describedby="helpCost" required>
      </div>
      <div id="helpCost" class="form-text offset-md-3">Must be between 0 and 999.99</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputURL" class="col-form-label">URL</label>
      </div>
      <div class="col-md-7">
        <input type="url" name="event[url]" value="<?= h($event->url); ?>" class="form-control" id="inputURL" maxlength="64" aria-describedby="helpURL">
      </div>
      <div id="helpURL" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhotoData" class="col-form-label">Photos</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[photo_data]" value="<?= h($event->photo_data); ?>" class="form-control" id="inputPhotoData" maxlength="64" aria-describedby="helpPhotoData">
      </div>
      <div id="helpPhotoData" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>
  </div>
</fieldset>