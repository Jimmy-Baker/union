<?php

/** 
 * Provides a relative path to a file
 *  
 * @param string $script_path The path to modify
 * @return string A relative path path 
 */
function url_for($script_path) {
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/** 
 * Encodes and removes special characters from urls for html use
 * 
 * @param string $string The url to modify 
 * @return string A prepared url 
 */
function u($string="") {
  return h(urlencode($string));
}

/** 
 * Performs encoding of non-alphanumeric characters in a url
 *  
 * @param string $string The url to modify
 * @return string A prepared url 
 */
function raw_u($string="") {
  return rawurlencode($string);
}

/** 
 * Replaces non-alphanumeric characters with HTML entities
 *  
 * @param string $string The string to modify 
 * @return string A prepared url 
 */
function h($string="") {
  return htmlspecialchars($string);
}

/** 
 * Redirects to a 404 page with message 
 */
function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

/** 
 * Redirects to a 500 page with message 
 */
function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

/** 
 * Redirects to a specific page with message
 * 
 * @param string $location The page to redirect to 
 */
function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

/** 
 * Tests for the receipt of a post request
 * 
 * @param boolean ex. True if post request present 
 */
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/** 
 * Tests for the receipt of a get request
 * 
 * @param boolean ex. True if post request present 
 */
function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

/** 
 * Formats a datetime to a recognizable string for display
 *  
 * @param string $datetime The datetime to modify 
 * @param string $unit The character or string to join with
 * @return string A processed date, ex. 10/20/2000
 */
function format_date($datetime, $unit) {
  $date = date_create($datetime);
  return h(date_format($date, "n".$unit."d".$unit."Y"));
}

/** 
 * Formats a datetime to a string for HTML use
 *  
 * @param string $datetime The datetime to modify 
 * @return string A processed date, ex. 2000-10-20
 */
function html_date($datetime) {
  $date = date_create($datetime);
  return h(date_format($date, "Y-m-d"));
}

/** 
 * Generates a current timestamp 
 *
 * @return string ex. 2000-10-20 16:15:14
 */
function timestamp() {
  return date("Y-m-d H:i:s");
}

/** 
 * Formats a number into a recognizable phone number
 *  
 * @param integer $country The country dialing prefix 
 * @param integer $phone The base phone number
 * @return string A formatted phone number, ex. (234) 567-8900
 */
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

/** 
 * Formats a number into a HTML-recognizable number for dialing
 *  
 * @param integer $country The country dialing prefix 
 * @param integer $phone The base phone number
 * @return string A formatted phone number, ex. +12345678900
 */
function format_call($country, $phone) {
  ($country == null || $country == 1) ? $string = '' : $string = '+'.$country;
  $string .= $phone;
  return $string;
}

/** 
 * Formats variables into a recognizable address for display
 * 
 * @param string $street The street address 
 * @param string $city The city
 * @param string $state The state
 * @param string $zip The zip code
 * @param string $country The country
 * @return string A formatted address
 */
function format_address($street, $city, $state, $zip, $country) {
  $string = $street . ', ' . $city . ', ' . $state . ' ' . $zip . ', ' . $country;
  return $string;
}

/** 
 * Places quotes around a variable or passes 'null' if null
 *  
 * @param string $a The variable to process 
 * @return string/null The modified string
 */
function quote_null($a) {
  if ($a === '') {
    return 'null';
  } else {
    return "'" . $a . "'";
  }
}

/** 
 * Tests for a null variable and returns '-' if null 
 * 
 * @param string The string to test 
 * @return string The string or '-' 
 */
function d($string="") {
  if ($string == "") {
    return '-';
  } else {
    return htmlspecialchars($string);
  }
}

/** 
 * Tests a variable for a JSON string 
 * 
 * @param string The variable to test
 * @return boolean ex. True if JSON detected
 */
function isJSON($string){
  json_decode($string);
  return json_last_error() === JSON_ERROR_NONE;
}

/** 
 * Tests a JSON array for length
 *  
 * @param array $json The array to test
 * @return int The length 
 */
function jnc($json) {
  if(is_null($json)){
    return 0;
  } else {
    return count($json);
  }
}

/** 
 * Tests for a country dialing prefix and returns a default if not present
 * 
 * @param string $input The string to test
 * @return string A country dialing prefix
 */
function default_prefix($input) {
  if($input == '') {
    return h('+1');
  } else {
    return h($input);
  }
}

/** 
 * Produces a 6=character alphanumeric code at random
 *   
 * @return string A 6-digit code 
 */
function random_six() {
  $factory = new RandomLib\Factory;
  $generator = $factory->getLowStrengthGenerator();
  return $generator->generateString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
}

/** 
 * Tests for the presence of a image name and provides a description
 *  
 * @param string $string 
 * @return string An image description
 */
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

/** 
 * Returns 'active' when a declared page is loaded
 *  
 * @param string $string The name of the page to test for 
 * @return string 'active'
 */
function active_class($string) {
  $name = basename($_SERVER['SCRIPT_NAME'], ".php");
  if($string == $name){
    return ' active';
  }
}

?>