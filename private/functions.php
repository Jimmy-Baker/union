<?php

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if(!function_exists('money_format')) {
  function money_format($format, $number) {
    return '$' . number_format($number, 2);
  }
}

//format datetime to a recognizable date
function format_date($datetime, $unit) {
  $date = date_create($datetime);
  return date_format($date, "n".$unit."d".$unit."Y");
}

function html_date($datetime) {
  $date = date_create($datetime);
  return date_format($date, "Y-m-d");
}

//format integers to a recognizable phone numnber
function format_phone($country, $phone) {
  if (strlen($phone) != 10) {
    $string = format_call($country, $phone);
   } else {
    if ($country == null || $country == 1)  {
      $string = ''; 
    } else {
     $string = '+'.$country;
    }
    $area = substr($phone, 0, 3);
    $three = substr($phone, 3, 3);
    $last = substr($phone, 6);
    $string .= ' (' . $area . ') ' . $three . '-' . $last;
   }
  return $string;
}

function format_call($country, $phone) {
  ($country == null || $country == 1) ? $string = '' : $string = '+'.$country;
  $string .= $phone;
  return $string;
}

function format_address($street, $city, $state, $zip, $country) {
  $string = $street . ', ' . $city . ', ' . $state . ' ' . $zip . ', ' . $country;
  return $string;
}

?>