<?php

/** 
 * Validates that the user has logged in or else redirects
 */
function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    $session->message('You must be logged in to view this page.', 'warning');
    redirect_to(url_for('/app/login.php'));
  } else {
    // do nothing
  }
}

/** 
 * Validates that the user has a minimum access level or else redirects
 *  
 * @param string $abv The minimum access required
 */
function require_access($abv) {
  global $session;
  $types = ['XX'=>0,'AA'=>1,'GM'=>2,'GS'=>3,'MM'=>4];
  if(!array_key_exists($abv, $types)){
    $session->message('You are not authorized to view this page.', 'warning');
    redirect_to($session->dashboard());
  } elseif($types[$session->access_abv] > $types[$abv]) {
    $session->message('You are not authorized to view this page.', 'warning');
    redirect_to($session->dashboard());
  }  
}

/** 
 * Tests if the user has a minimum access level
 *  
 * @param string $abv The minimum access level
 * @return boolean ex. True if the user's access level is greater than the minimum 
 */
function test_access($abv) {
  global $session;
  $types = ['XX'=>0,'AA'=>1,'GM'=>2,'GS'=>3,'MM'=>4];
  if(!array_key_exists($abv, $types)){
    return false;
  } elseif($types[$session->access_abv] > $types[$abv]) {
    return false;
  } else {
    return true;
  }
}

/** 
 * Provides an arrayed response for an array of access levels
 *  
 * @param array $a The array of access levels
 * @param array $b The array of responses
 * @return string The resonse for a matched access level 
 */
function access(array $a, array $c) {
  global $session;
  $key = array_search($session->access_abv, $a);
  if($key !== false) {
    return $c[$key];
  } else {
    return false;
  }
}

/** 
 * Iterates through an error array to produce a javascript function
 *  
 * @param array $error_array An array of HTML objects and messages 
 * @return string A javascript function 
 */
function display_errors($error_array=array()) {
  if(!empty($error_array)) {
    $script = "<script defer>";
    foreach($error_array as $field_name=>$message) {
      $input = ('input'.$field_name);
      $help = ('help'.$field_name);
      $script .= "var input = document.getElementById('$input');";
      $script .= "var help = document.getElementById('$help');";
      $script .= "if(input){";
      $script .= "input.className += ' is-invalid';";
      $script .= "} if(help) {";
      $script .= "help.innerText = '$message';";
      $script .= "help.className += ' text-danger';";
      $script .= "}";
    }
    $script .= "</script>";
    return $script;
  }
}

/** 
 * Provides a session message to the user
 *
 * @return string A HTML div populated with a message 
 */
function display_session_message() {
  global $session;
  $msg = $session->message();
  $class = $_SESSION['message_class'] ?? 'primary'; 
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div class="container fixed-message"><div class="alert alert-'. $class . ' alert-dismissible fade show" id="message" role="alert">' . h($msg) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>';
  }
}

?>