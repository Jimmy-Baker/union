<?php

class Session {

  public $user_id;
  public $email;
  public $access_abv;
  public $name;
  public $avatar_url;
  public $location;
  public $location_name;
  public $gym_id;
  public $gym_name;
  public $pass_id;
  private $last_login;

  public const MAX_LOGIN_AGE = 60*60*24; // 1 day

  /** 
   * Constructs a Session object and checks for stored session information   
   *   
   * @return object An instantiated session
   */
  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  /** 
   * Converts User information to Session values and start a new session
   * 
   * @param object $user A specific user to login
   * @return boolean ex. True if login was successful 
   */
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
      
      $data = $user->session_query();
      $this->location_name = $_SESSION['location_name'] = $data->location_name;
      $this->gym_id= $_SESSION['gym_id'] = $data->gym_id;
      $this->gym_name = $_SESSION['gym_name'] = $data->gym_name;
      $this->pass_id = $_SESSION['pass_id'] = $data->pass_id;
      
      $this->last_login = $_SESSION['last_login'] = time();
    }
    return true;
  }

  /** 
   * Checks if someone is already logged into the given session
   *
   * @return boolean ex. True if a login is already present  
   */
  public function is_logged_in() {
    return isset($this->user_id) && $this->last_login_is_recent();
  }

  /** 
   * Clears stored Session properties and variables
   *
   * @return boolean ex. True after unsetting  
   */
  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['email']);
    unset($_SESSION['access_abv']);
    unset($_SESSION['name']);
    unset($_SESSION['avatar_url']);
    unset($_SESSION['location']);
    unset($_SESSION['location_name']);
    unset($_SESSION['gym_id']);
    unset($_SESSION['gym_name']);
    unset($_SESSION['pass_id']);
    unset($_SESSION['last_login']);
    unset($this->user_id);
    unset($this->email);
    unset($this->access_abv);
    unset($this->name);
    unset($this->avatar_url);
    unset($this->location);
    unset($this->location_name);
    unset($this->gym_id);
    unset($this->gym_name);
    unset($this->pass_id);
    unset($this->last_login);
    
    return true;
  }

  /** 
   * Checks for set user_id session variable and sets Session properties if present 
   *
   */
  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->email = $_SESSION['email'];
      $this->access_abv = $_SESSION['access_abv'];
      $this->name = $_SESSION['name'];
      $this->avatar_url = $_SESSION['avatar_url'];
      $this->location = $_SESSION['location'];
      $this->location_name = $_SESSION['location_name'] ?? '';
      $this->gym_id= $_SESSION['gym_id'] ?? '';
      $this->gym_name = $_SESSION['gym_name'] ?? '';
      $this->pass_id = $_SESSION['pass_id'] ?? '';
      $this->last_login = $_SESSION['last_login'] ?? '';
    }
  }

  /** 
   * Tests for a recent session login against MAX_LOGIN_AGE
   *
   * @return boolean ex True if login was within 1 day
   */
  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

  /** 
   * Sets or gets a message for display based on a page
   *  
   * @param string $msg The message to display
   * @param string $class The CSS class to apply to the message
   * @return boolean/string ex. True if set or $msg if get
   */
  public function message($msg="", $class="") {
    if(!empty($msg)) {
      $_SESSION['message'] = $msg;
      $_SESSION['message_class'] = $class;
      return true;
    } else {
      return $_SESSION['message'] ?? '';
    }
  }

  /** 
   * Clears the session message variable after displaying 
   *  
   */
  public function clear_message() {
    unset($_SESSION['message']);
    unset($_SESSION['message_class']);
  }
  
  public function dashboard() {
        return url_for('/app/dashboard/index.php');
  }
  
  /** 
   * Concatenates gym and location names stored in the current session
   * 
   * @return string ex. RockCity Asheville 
   */
  public function gym_location() {
    return $this->gym_name . " " . $this->location_name;
  }
}

?>