<?php

class User extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'middle_name', 'preferred_name', 'birth_date', 'avatar_url', 'street_address', 'city', 'zip', 'state_abv', 'country_abv', 'email', 'phone_primary', 'phone_p_country', 'phone_secondary', 'phone_s_country', 'first_name_emergency', 'last_name_emergency', 'phone_emergency', 'phone_e_country', 'password_hash', 'access_abv', 'created_at', 'primary_location'];
  
  public $id;
  public $first_name;
  public $last_name;
  public $middle_name;
  public $preferred_name;
  public $birth_date;
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
  public $primary_location;
  
  public $upload_img;
  public $upload_name;
  public $password;
  public $confirm_password;
  protected $password_required = true;
  
  public const USER_TYPES = ['AA'=>'Administrator','GM'=>'Gym Manager', 'GS'=>'Gym Staff','MM'=>'Member', ''=>'None'];

  /** 
   * Constructs a User object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated user
   */
  public function __construct($args=[]) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->middle_name = $args['middle_name'] ?? '';
    $this->preferred_name = $args['preferred_name'] ?? '';
    $this->birth_date = $args['birth_date'] ?? '';
    $this->group_id = $args['group_id'] ?? '';
    $this->avatar_url = $args['avatar_url'] ?? '/public/upload/profile/default.png';
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
    $this->access_abv = $args['access_abv'] ?? 'MM';
    $this->primary_location = $args['primary_location'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  /** 
   * Concatenates first, middle, and last name values
   *
   * @return string ex. John Jacob Smith or John Smith
   */
  public function full_name() {
    $middle = ($this->middle_name = '') ? $this->middle_name . " " : "";
    return $this->first_name . " " . $middle . $this->last_name;
  }

  /** 
   * Provides a first or preferred name, if one exists 
   * 
   * @return string ex. John or Johnny
   */
  public function name() {
    switch ($this->preferred_name) {
      case '':
        return $this->first_name;
        break;
      default:
        return $this->preferred_name;
    }
  }
  
  /** 
   * Updates a User's password_hash with the BCRYPT of its password
   *  
   */
  protected function set_password_hash() {
    $this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);
  }

  /** 
   * Tests a string against the User's password_hash  
   * 
   * @param string $password A string to test 
   * @return boolean ex. True or False  
   */
  public function verify_password($password) {
    return password_verify($password, $this->password_hash);
  }

  /** 
   * Sets the User's password_hash before creating a database record  
   * 
   * @return boolean ex. True if record was created sucessfully
   */
  protected function create() {
    $this->set_password_hash();
    return parent::create();
  }

  /** 
   * Sets the User's password_hash before updating a database record 
   *  
   * @return boolean ex. True if record was updated successfully  
   */
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

  /** 
   * Tests User properties for valid HTML input values
   *
   * @return array HTML elements as keys and messages as values 
   */
  protected function validate() {    
    $this->error_array = [];
    if(is_blank($this->first_name)) {
      $this->error_array += ["FirstName" => "First name cannot be blank."];
    } elseif (!has_length($this->first_name, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["FirstName" => "First name must be less than 32 characters."];
    } elseif (has_padding($this->first_name)) {
      $this->error_array += ["FirstName" => "First name cannot start or end with a space."];
    } elseif (!has_valid_name($this->first_name)) {
      $this->error_array += ["FirstName" => "First name can only contain letters, dashes, and spaces."];
    }

    if(is_blank($this->last_name)) {
      $this->error_array += ["LastName" => "Last name cannot be blank."];
    } elseif (!has_length($this->last_name, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["LastName" => "Last name must be less than 32 characters."];
    } elseif (has_padding($this->last_name)) {
      $this->error_array += ["LastName" => "Last name cannot start or end with a space."];
    } elseif (!has_valid_name($this->last_name)) {
      $this->error_array += ["LastName" => "Last name can only contain letters, dashes, and spaces."];
    }

    if(!has_length($this->middle_name, array('max' => 32))) {
      $this->error_array += ["MiddleName" => "Middle name must be less than 32 characters."];
    } elseif (has_padding($this->middle_name)) {
      $this->error_array += ["MiddleName" => "Middle name cannot start or end with a space."];
    } elseif (!has_valid_name($this->middle_name)) {
      $this->error_array += ["MiddleName" => "Middle name can only contain letters, dashes, and spaces."];
    }
    
    if(!has_length($this->preferred_name, array('max' => 32))) {
      $this->error_array += ["PreferredName" => "Preferred name must be less than 32 characters."];
    } elseif (has_padding($this->preferred_name)) {
      $this->error_array += ["PreferredName" => "Preferred name cannot start or end with a space."];
    } elseif (!has_valid_name($this->preferred_name)) {
      $this->error_array += ["PreferredName" => "Preferred name can only contain letters, dashes, and spaces."];
    }
    
    if(is_blank($this->birth_date)) {
      $this->error_array += ["BirthDate" => "Birth date cannot be blank."];
    } elseif (!has_date($this->birth_date, array('min' => '1902-01-01', 'max' => 'now'))) {
      $this->error_array += ["BirthDate" => "Must be between in the past 100 years."];
    }
    
    if(is_blank($this->street_address)) {
      $this->error_array += ["StreetAddress" => "Street address cannot be blank."];
    } elseif (!has_length($this->street_address, array('min' => 6, 'max'=>64))) {
      $this->error_array += ["StreetAddress" => "Street address must be between 6 and 64 characters."];
    } elseif (has_padding($this->street_address)) {
      $this->error_array += ["StreetAddress" => "Street address cannot start or end with a space."];
    }
    
    if(is_blank($this->city)) {
      $this->error_array += ["City" => "City cannot be blank."];
    } elseif (!has_valid_name($this->city)) {
      $this->error_array += ["City" => "City can only contain letters, dashes, and spaces."];
    } elseif (!has_length($this->city, array('min'=>2, 'max'=>64))) {
      $this->error_array += ["City" => "City must contain 2 or more characters."];
    } 
    
    if(is_blank($this->state_abv)) {
      $this->error_array += ["State" => "State must be selected."];
    }
    
    if(is_blank($this->zip)) {
      $this->error_array += ["Zip" => "Zip code cannot be blank."];
    } elseif (!ctype_digit($this->zip)) {
      $this->error_array += ["Zip" => "Zip code can only contain numerals."];
    } elseif (!has_length($this->zip, array('exact' => 5))) {
      $this->error_array += ["Zip" => "Zip code must be exactly 5 digits."];
    }
      
    if(is_blank($this->country_abv)) {
      $this->error_array += ["CountryAbv" => "Country must be selected."];
    }
    
    if(is_blank($this->primary_location)) {
      $this->error_array += ["PrimaryLocation" => "Primary location cannot be blank."];
    } elseif (!ctype_digit($this->zip)) {
      $this->error_array += ["PrimaryLocation" => "Primary location can only contain numerals."];
    }
    
    if(is_blank($this->email)) {
      $this->error_array += ["Email" => "Email cannot be blank."];
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->error_array += ["Email" => "Email must be less than 255 characters."];
    } elseif (has_padding($this->email)) {
      $this->error_array += ["Email" => "Email cannot start or end with a space."];
    } elseif (!has_valid_email_format($this->email)) {
      $this->error_array += ["Email" => "Email must be a valid format."];
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->error_array += ["Email" => "This email is unavailable for registration."];
    }

    if(is_blank($this->phone_primary)) {
      $this->error_array += ["PhonePrimary" => "Primary phone cannot be blank."];
    } elseif (!ctype_digit($this->phone_primary)) {
      $this->error_array += ["PhonePrimary" => "Primary phone can only contain numerals."];
    } elseif (!has_length($this->phone_primary, array('min' => 10, 'max'=>12))) {
      $this->error_array += ["PhonePrimary" => "Primary phone must be 10 to 12 digits."];
    }
    
    if (!is_blank($this->phone_secondary)) {
      if (!has_length($this->phone_secondary, array('min' => 10, 'max'=>12))) {
        $this->error_array += ["PhoneSecondary" => "Secondary phone must be 10 to 12 digits."];
      } elseif (!ctype_digit($this->phone_primary)) {
        $this->error_array += ["PhoneSecondary" => "Secondary phone can only contain numerals."];
      }
    }
    
    if(is_blank($this->first_name_emergency)) {
      $this->error_array += ["EmergencyFirst" => "Contact\'s first name cannot be blank."];
    } elseif (!has_length($this->first_name_emergency, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["EmergencyFirst" => "Contact\'s first name must be less than 32 characters."];
    } elseif (has_padding($this->first_name_emergency)) {
      $this->error_array += ["EmergencyFirst" => "Contact\'s first name cannot start or end with a space."];
    } elseif (!has_valid_name($this->first_name_emergency)) {
      $this->error_array += ["EmergencyFirst" => "Contact\'s first name can only contain letters, dashes, and spaces."];
    }
    
    if(is_blank($this->last_name_emergency)) {
      $this->error_array += ["EmergencyLast" => "Contact\'s last name cannot be blank."];
    } elseif (!has_length($this->last_name_emergency, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["EmergencyLast" => "Contact\'s last name must be less than 32 characters."];
    } elseif (has_padding($this->last_name_emergency)) {
      $this->error_array += ["EmergencyLast" => "Contact\'s last name cannot start or end with a space."];
    } elseif (!has_valid_name($this->last_name_emergency)) {
      $this->error_array += ["EmergencyLast" => "Contact\'s last name can only contain letters, dashes, and spaces."];
    }
    
    if(is_blank($this->phone_emergency)) {
      $this->error_array += ["PhoneEmergency" => "Contact\'s phone cannot be blank."];
    } elseif (!has_length($this->phone_emergency, array('min' => 10, 'max'=>12))) {
      $this->error_array += ["PhoneEmergency" => "Secondary phone must be 10 to 12 digits."];
    } elseif (!ctype_digit($this->phone_emergency)) {
      $this->error_array += ["PhoneEmergency" => "Contact\'s phone can only contain numerals."];
    }
    
    if(!isset($this->access_abv)) {
      $this->error_array += ["AccessAbv" => "User access must be selected."];
    }
    
    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->error_array += ["Password" => "Password cannot be blank."];
      } elseif (!has_length($this->password, array('min' => 8))) {
        $this->error_array += ["Password" => "Password must contain 8 or more characters."];
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->error_array += ["Password" => "Password must contain at least 1 uppercase letter."];
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->error_array += ["Password" => "Password must contain at least 1 lowercase letter."];
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->error_array += ["Password" => "Password must contain at least 1 symbol."];
      } elseif (has_spaces($this->password)) {
        $this->error_array += ["Password" => "Password cannot contain spaces."];
      }
      
      if(is_blank($this->confirm_password)) {
        $this->error_array += ["ConfirmPassword" => "Confirm password cannot be blank."];
      } elseif ($this->password !== $this->confirm_password) {
        $this->error_array += ["ConfirmPassword" => "Password and confirm password must match."];
      }
    }

    return $this->error_array;
  }

  /** 
   * Finds a single User in the database with a given email
   * 
   * @param string $email The email to search database records for 
   * @return object An instantiated User 
   */
  public static function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  /** 
   * Finds a single User in the database with a given phone number 
   * 
   * @param string $phone The email to search database records for  
   * @return object An instantiated User
   */
  static public function find_by_phone($phone) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE phone_primary='" . self::$database->escape_string($phone) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  /** 
   * Finds multiple Users in the database based on access type 
   * 
   * @param string $access_abv The access type to search database records for  
   * @return object An array of instantiated Users
   */
  static public function find_by_access($access_abv) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE access_abv='" . self::$database->escape_string($access_abv) . "'";
    return static::find_by_sql($sql);
  }
  
  /** 
   * Finds a user_id and pass_id in the database with a user field 
   * 
   * @param string $param The user field to search database records for  
   * @param string $value The value for the given user field
   * @return object An instantiated User
   */
  static public function find_expanded_pass_by_param($param, $value){
    $sql = "SELECT users.id, users.first_name, users.last_name, passes.id AS pass_id FROM users INNER JOIN passes ON users.id=passes.user_id";
    $sql .= " WHERE users." . self::$database->escape_string($param) . "='" . self::$database->escape_string($value) . "'";
    $sql .= " AND passes.is_active=1 ORDER BY passes.created_at LIMIT 1";
    $results = self::$database->query($sql);
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
    }
    $results->free();
    return $object;
  }
  
  /** 
   * Provides a long-form user type based on a User's access_abv
   *
   * @return string ex. Administrator or Gym Staff 
   */
  public function user_type() {
      return self::USER_TYPES[$this->access_abv]; 
  }
  
  /** 
   * Provide additional data related to the User for session initialization
   *
   * @return object preferred location details for a given user 
   */
  public function session_query() {
    $sql = "SELECT locations.location_name AS location_name, locations.gym_id AS gym_id, gyms.gym_name AS gym_name, IFNULL((SELECT id FROM passes WHERE user_id='" . self::$database->escape_string($this->id) . "' AND is_active=1 ORDER BY created_at DESC LIMIT 1), 'null') AS pass_id FROM (locations JOIN gyms ON locations.gym_id=gyms.id) WHERE locations.id='" . self::$database->escape_string($this->primary_location) . "' LIMIT 1;";
      $results = self::$database->query($sql);
      $array = [];
      while($record = $results->fetch_assoc()){
        $object = (object) $record;
        $array[] = $object;
      }
    $results->free();
    return array_shift($array);
  }
}

?>