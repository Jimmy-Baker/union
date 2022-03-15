<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/private/initialize.php');

// Log out the user
$session->logout();

redirect_to(url_for('/index.php'));

?>