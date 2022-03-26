<?php

class Session {

  public $user_id;
  public $email;
  public $access_abv;
  public $name;
  public $avatar_url;
  public $location;
  public $location_name;
  public $gym;
  public $gym_name;
  private $last_login;

  public const MAX_LOGIN_AGE = 60*60*24; // 1 day

  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  public function login($user) {
    if($user) {
      // prevent session fixation attacks
      session_regenerate_id();
      $this->user_id = $_SESSION['user_id'] = $user->id;
      $this->email = $_SESSION['email'] = $user->email;
      $this->access_abv = $_SESSION['access_abv'] = $user->access_abv;
      $this->name = $_SESSION['name'] = $user->name();
      $this->avatar_url = $_SESSION['avatar_url'] = $user->avatar_url;
      $this->location = $_SESSION['location'] = $user->primary_location;
      $this->location_name = $_SESSION['location_name'] = Location::return_param_by_id("location_name", $this->location);
      $this->gym = $_SESSION['gym'] = Location::return_param_by_id("gym_id", $this->location);
      $this->gym_name = $_SESSION['gym_name'] = Gym::return_param_by_id("gym_name", $this->gym);
      $this->last_login = $_SESSION['last_login'] = time();
    }
    return true;
  }

  public function is_logged_in() {
    // return isset($this->user_id);
    return isset($this->user_id) && $this->last_login_is_recent();
  }

  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['email']);
    unset($_SESSION['access_abv']);
    unset($_SESSION['name']);
    unset($_SESSION['avatar_url']);
    unset($_SESSION['location']);
    unset($_SESSION['location_name']);
    unset($_SESSION['gym']);
    unset($_SESSION['gym_name']);
    unset($_SESSION['last_login']);
    unset($this->user_id);
    unset($this->email);
    unset($this->access_abv);
    unset($this->name);
    unset($this->avatar_url);
    unset($this->location);
    unset($this->location_name);
    unset($this->gym);
    unset($this->gym_name);
    unset($this->last_login);
    
    return true;
  }

  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->email = $_SESSION['email'];
      $this->access_abv = $_SESSION['access_abv'];
      $this->name = $_SESSION['name'];
      $this->avatar_url = $_SESSION['avatar_url'];
      $this->location = $_SESSION['location'];
      $this->location_name = $_SESSION['location_name'];
      $this->gym = $_SESSION['gym'];
      $this->location_name = $_SESSION['gym_name'];
      $this->last_login = $_SESSION['last_login'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

  public function message($msg="", $class="") {
    if(!empty($msg)) {
      // Then this is a "set" message
      $_SESSION['message'] = $msg;
      $_SESSION['message_class'] = $class;
      return true;
    } else {
      // Then this is a "get" message
      return $_SESSION['message'] ?? '';
    }
  }

  public function clear_message() {
    unset($_SESSION['message']);
    unset($_SESSION['message_class']);
  }
  
  public function dashboard() {
    switch ($this->access_abv) {
      case "AA":
        return url_for('/app/admin/index.php');
        break;
      case "GS":
        return url_for('/app/staff/index.php');
        break; 
      case "GM":
        return url_for('app/staff/index.php');
        break;
      default:
        return url_for('app/member/index.php');
    }
  }
  
  public function gym_location() {
    return $this->gym_name . "" . $this->location_name;
  }
}

?>