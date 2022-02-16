<?php

function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('/app/login.php'));
  } else {
    // do nothing
  }
}


function display_errors($error_array=array()) {
  $output = '';
  if(!empty($error_array)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($error_array as $error) {
      $output .= "<li>" . h($error[1]) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function error_css($error_array=array()){
  $output = '';
  if(!empty($error_array)) {
    
    $output .="<script>";
    foreach($error_array as $key=>$value){
      
      $output .="element_" . $key . "=document.querySelector('". $value[0] ."');";
      $output .="element_" . $key . ".classList.add('inputerror');";
    }
    $output .="</script>";
  }
  return $output;
}


function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>
