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

function timestamp() {
  return date("Y-m-d H:i:s");
}

//format integers to a recognizable phone numnber
function format_phone($country, $phone) {
  if (strlen($phone) != 10) {
    $string = format_call($country, $phone);
   } else {
    if ($country == null || $country == 1)  {
      $string = ''; 
    } else {
     $string = '+'.$country.' ';
    }
    $area = substr($phone, 0, 3);
    $three = substr($phone, 3, 3);
    $last = substr($phone, 6);
    $string .= '(' . $area . ') ' . $three . '-' . $last;
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

function quote_null($a) {
  if ($a === '') {
    return 'null';
  } else {
    return "'" . $a . "'";
  }
}

function d($string="") {
  if ($string == "") {
    return '-';
  } else {
    return htmlspecialchars($string);
  }
}

function isJSON($string){
  json_decode($string);
  return json_last_error() === JSON_ERROR_NONE;
}

function jnc($json) {
  if(is_null($json)){
    return 0;
  } else {
    return count($json);
  }
}

function default_prefix($input) {
  if($input == '') {
    return h('+1');
  } else {
    return h($input);
  }
}

function random_six() {
  $factory = new RandomLib\Factory;
  $generator = $factory->getLowStrengthGenerator();
  return $generator->generateString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
}

function image_name($string="") {
  if($string=="") {
    $message = "No Image";
  } else {
    $name = substr($string, -10, 7);
    switch ($name){
      case "default": $message="Default Image";
        break;
      default: $message="User Provided Image";
        break;
    }
  }
  return $message;
}

function active_class($string) {
  $name = basename($_SERVER['SCRIPT_NAME'], ".php");
  if($string == $name){
    return ' active';
  }
}

?>