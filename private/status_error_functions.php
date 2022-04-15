<?php

function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('/app/login.php'));
  } else {
    // do nothing
  }
}

function require_access($abv) {
  global $session;
  $types = ['XX'=>0,'AA'=>1,'GM'=>2,'GS'=>3,'MM'=>4];
  if(!array_key_exists($abv, $types)){
    redirect_to($session->dashboard());
  } elseif($types[$session->access_abv] > $types[$abv]) {
    redirect_to($session->dashboard());
  }  
}

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

function access(array $a, array $c) {
  global $session;
  $key = array_search($session->access_abv, $a);
  if($key !== false) {
    return $c[$key];
  } else {
    return false;
  }
}

function test_path(){
  echo basename($_SERVER["SCRIPT_NAME"]);
}


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