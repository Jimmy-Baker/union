<?php

class User extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'middle_name', 'preferred_name', 'birth_date', 'group_id', 'avatar_url', 'street_address', 'city', 'zip', 'state_abv', 'country_abv', 'email', 'phone_primary', 'phone_p_country', 'phone_secondary', 'phone_s_country', 'first_name_emergency', 'last_name_emergency', 'phone_emergency', 'phone_e_country', 'password_hash', 'access_abv', 'created_at'];

  public function table() {
    return static::$table_name;
  }
  
  public $id;
  public $first_name;
  public $last_name;
  public $middle_name;
  public $preferred_name;
  public $birth_date;
  public $group_id;
  public $avatar_url;
  public $street_address;
  public $city;
  public $zip;
  public $state_abv;
  public $country_abv;
  public $email;
  public $phone_primary;
  public $phone_p_country;
  public $phone_secondary;
  public $phone_s_country;
  public $first_name_emergency;
  public $last_name_emergency;
  public $phone_emergency;
  public $phone_e_country;
  protected $password_hash;
  public $access_abv;
  public $created_at;
  
  public $upload_img;
  public $upload_name;
  public $password;
  public $confirm_password;
  protected $password_required = true;
  
  public const USER_TYPES = ['AA'=>'Administrator','GM'=>'Gym Manager', 'GS'=>'Gym Staff','MM'=>'Member', ''=>'None'];

  public function __construct($args=[]) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->middle_name = $args['middle_name'] ?? '';
    $this->preferred_name = $args['preferred_name'] ?? '';
    $this->birth_date = $args['birth_date'] ?? '';
    $this->group_id = $args['group_id'] ?? '';
    $this->avatar_url = $args['avatar_url'] ?? '';
    $this->street_address = $args['street_address'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->zip = $args['zip'] ?? '';
    $this->state_abv = $args['state_abv'] ?? '';
    $this->country_abv = $args['country_abv'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone_primary = $args['phone_primary'] ?? '';
    $this->phone_p_country = $args['phone_p_country'] ?? '';
    $this->phone_secondary = $args['phone_secondary'] ?? '';
    $this->phone_s_country = $args['phone_s_country'] ?? '';
    $this->first_name_emergency = $args['first_name_emergency'] ?? '';
    $this->last_name_emergency = $args['last_name_emergency'] ?? '';
    $this->phone_emergency = $args['phone_emergency'] ?? '';
    $this->phone_e_country = $args['phone_e_country'] ?? '';
    $this->access_abv = $args['access_abv'] ?? '';
    
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  public function full_name() {
    return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
  }

  /**  
   * Use built-in PHP methods to encrypt a property/password  
   * 
   * @param {property} $this->password
   *   
   **/
  protected function set_password_hash() {
    $this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->password_hash);
  }

  /**   
   * Modify DatabaseObject::create() to encrypt the password before instantiation  
   * 
   * @returns {object} parent::create() (new instance of a DBO) 
   * 
   **/
  protected function create() {
    $this->set_password_hash();
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
      $this->set_password_hash();
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
      $this->error_array[] = ["#first_name", "First name must be between 2 and 64 characters."];
    }

    if(is_blank($this->last_name)) {
      $this->error_array[] = ["#last_name", "Last name cannot be blank."];
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
      $this->error_array[] = ["#last_name", "Last name must be between 2 and 64 characters."];
    }

    if(is_blank($this->email)) {
      $this->error_array[] = ["#email", "Email cannot be blank."];
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->error_array[] = ["#last_name", "Last name must be less than 255 characters."];
    } elseif (!has_valid_email_format($this->email)) {
      $this->error_array[] = ["#email", "Email must be a valid format."];
    }

    if(is_blank($this->email)) {
      $this->error_array[] = ["#email", "email cannot be blank."];
    } elseif (!has_length($this->email, array('min' => 8, 'max' => 255))) {
      $this->error_array[] = ["#email", "email must be between 8 and 255 characters."];
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->error_array[] = ["#email","email not allowed. Try another."];
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->error_array[] = ["#password", "Password cannot be blank."];
      } elseif (!has_length($this->password, array('min' => 8))) {
        $this->error_array[] = ["#password", "Password must contain 8 or more characters"];
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 uppercase letter"];
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 lowercase letter"];
      // } elseif (!preg_match('/[0-9]/', $this->password)) {
      //   $this->error_array[] = ["#password", "Password must contain at least 1 number"];
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->error_array[] = ["#password", "Password must contain at least 1 symbol"];
      }

      if(is_blank($this->confirm_password)) {
        $this->error_array[] = ["#confirm_password", "Confirm password cannot be blank."];
      } elseif ($this->password !== $this->confirm_password) {
        $this->error_array[] = ["#confirm_password", "Password and confirm password must match."];
      }
    }
    
    if(!isset($this->access_abv)) {
      $this->error_array[] = ["#access_abv", "User access must be selected"];
    }

    return $this->error_array;
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_access($access_abv) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE access_abv='" . self::$database->escape_string($access_abv) . "'";
    return static::find_by_sql($sql);
  }
  
  public function user_type() {
      return self::USER_TYPES[$this->access_abv]; 
  }
}

?>