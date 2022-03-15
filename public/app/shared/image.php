<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php'); ?>

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
    <script src="<?= url_for("/js/gcs_image.js");?>" defer></script>
  </head>

  <body>
    <form id="fileUploadForm" method="post" enctype="multipart/form-data" action="../../../private/gcs_requests.php?action=upload">
      <input type="file" name="file" />
      <input type="submit" name="upload" value="Upload" />
      <span id="uploadingmsg"></span>
      <hr />
      <strong>Response (JSON)</strong>
      <pre id="json">json response will be shown here</pre>

      <hr />
      <strong>Public Link</strong> <span>(https://storage.googleapis.com/[BUCKET_NAME]/[OBJECT_NAME])</span><br />
      <b>Note:</b> we can use this link only if object or the whole bucket has made public, which in our case has already made bucket public<br />
      <div id="output"></div>
    </form>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
    $("#fileUploadForm").submit(function(e) {
      e.preventDefault();
      var action = "../../../gcs_requests.php?action=upload";
      $("#uploadingmsg").html("Uploading...");
      var data = new FormData(e.target);
      $.ajax({
        type: 'POST',
        url: action,
        data: data,
        /*THIS MUST BE DONE FOR FILE UPLOADING*/
        contentType: false,
        processData: false,
      }).done(function(response) {
        $("#uploadingmsg").html("");
        $("#json").html(JSON.stringify(response, null, 4));
        //https://storage.googleapis.com/[BUCKET_NAME]/[OBJECT_NAME]
        $("#output").html('<a href="https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '"><i>https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '</i></a>');
        if (response.data.contentType === 'image/jpeg' || response.data.contentType === 'image/jpg' || response.data.contentType === 'image/png') {
          $("#output").append('<br/><img src="https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '"/>');
        }
      }).fail(function(data) {
        //any message
      });
    });
    </script> -->
  </body>

</html>