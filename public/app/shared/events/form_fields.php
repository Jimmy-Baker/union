<?php
// prevent this code from being loaded directly
if(!isset($event)) {
  redirect_to(url_for('/staff/events/events.php'));
}

$states = State::all_states();
$countries = Country::all_countries();
$today = date('Y-m-d');
$accesses = User::USER_TYPES; 
?>

<fieldset class="card shadow col-md-10 mx-auto mb-4">
  <legend class="card-header">Profile Information</legend>
  <div class="card-body">

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputStartDate" class="col-form-label">Start Date</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[start_date]" value="<?php echo h($event->first_name); ?>" class="form-control" id="inputStartDate" maxlength="32" aria-describedby="startDateHelp" required>
      </div>
      <div id="startDateHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEndDate" class="col-form-label">End Date</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[end_date]" value="<?php echo h($event->end_date); ?>" class="form-control" id="inputEndDate" aria-describedby="endDateHelp" maxlength="32">
      </div>
      <div id="endDateHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputLocationID" class="col-form-label">Location ID</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[location_id]" value="<?php echo h($event->location_id); ?>" class="form-control" id="inputLocationID" maxlength="32" aria-describedby="locationIDHelp" required>
      </div>
      <div id="locationIDHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputEventName" class="col-form-label">Event Name</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[event_name]" value="<?php echo h($event->event_name); ?>" class="form-control" aria-describedby="eventNameHelp" id="inputEventName">
      </div>
      <div id="eventNameHelp" class="form-text offset-md-3">Maximum of 32 characters</div>
    </div>

    <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputParticipants" class="col-form-label">Participants</label>
      </div>
      <div class="col-md-7">
        <input type="date" name="event[participants]" value="<?php echo h(html_date($event->participants)); ?>" class="form-control" id="inputParticipants" min="1902-01-01" max="<?= $today; ?>" aria-describedby="participantsHelp" required>
      </div>
      <div id="participantsHelp" class="form-text offset-md-3">Must be between 01/01/1902 and <?= format_date($today, "/"); ?></div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputCost" class="col-form-label">Cost</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[cost]" value="<?php echo h($event->cost); ?>" class="form-control" id="inputCost" maxlength="64" aria-describedby="costHelp" required>
      </div>
      <div id="costHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputURL" class="col-form-label">URL</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[url]" value="<?php echo h($event->url); ?>" class="form-control" id="inputURL" maxlength="64" aria-describedby="urlHelp" required>
      </div>
      <div id="urlHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>

    <div class=" row row-cols-md-auto align-items-center mb-3 mb-md-4">
      <div class="col-md-3 text-md-end">
        <label for="inputPhotoData" class="col-form-label">Photos</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="event[photo_data]" value="<?php echo h($event->photo_data); ?>" class="form-control" id="inputPhotoData" maxlength="64" aria-describedby="photoDataHelp" required>
      </div>
      <div id="photoDataHelp" class="form-text offset-md-3">Maximum of 64 characters</div>
    </div>
  </div>
</fieldset>