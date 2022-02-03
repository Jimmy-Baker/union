<?php

class User extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'username', 'hashed_password', 'user_level'];

  public $id;
  public $first_name;
  public $last_name;
  public $email;
  public $username;
  protected $hashed_password;
  public $user_level;
  public $password;
  public $confirm_password;
  protected $password_required = true;

  public function __construct($args=[]) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->user_level = $args['user_level'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  public function full_name() {
    return $this->first_name . " " . $this->last_name;
  }

  /**  
   * Use built-in PHP methods to encrypt a property/password  
   * 
   * @param {property} $this->password
   *   
   **/
  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  /**   
   * Modify DatabaseObject::create() to encrypt the password before instantiation  
   * 
   * @returns {object} parent::create() (new instance of a DBO) 
   * 
   **/
  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  /**   
   * Modifies DatabaseObject::update() to encrypt the password before updating  
   * 
   * @returns {object} parent::update() (updated instance of a DBO) 
   * 
   **/
  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      // validate password
    } else {
      // password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->first_name)) {
      $this->error_array[] = ["#first_name", "First name cannot be blank."];
    } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
      $this->error_array[] = ["#first_name", "First name must be between 2 and 255 characters."];
    }

    if(is_blank($this->last_name)) {
      $this->error_array[] = ["#last_name", "Last name cannot be blank."];
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
      $this->error_array[] = ["#last_name", "Last name must be between 2 and 255 characters."];
    }

    if(is_blank($this->email)) {
      $this->error_array[] = ["#email", "Email cannot be blank."];
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->error_array[] = ["#last_name", "Last name must be less than 255 characters."];
    } elseif (!has_valid_email_format($this->email)) {
      $this->error_array[] = ["#email", "Email must be a valid format."];
    }

    if(is_blank($this->username)) {
      $this->error_array[] = ["#username", "Username cannot be blank."];
    } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
      $this->error_array[] = ["#username", "Username must be between 8 and 255 characters."];
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->error_array[] = ["#username","Username not allowed. Try another."];
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->error_array[] = ["#password", "Password cannot be blank."];
      } elseif (!has_length($this->password, array('min' => 12))) {
        $this->error_array[] = ["#password", "Password must contain 12 or more characters"];
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 uppercase letter"];
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 lowercase letter"];
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 number"];
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 symbol"];
      }

      if(is_blank($this->confirm_password)) {
        $this->error_array[] = ["#confirm_password", "Confirm password cannot be blank."];
      } elseif ($this->password !== $this->confirm_password) {
        $this->error_array[] = ["#confirm_password", "Password and confirm password must match."];
      }
    }
    
    if(!isset($this->user_level)) {
      $this->error_array[] = ["#user_level", "User level must be selected"];
    }

    return $this->error_array;
  }

  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

}

?>
