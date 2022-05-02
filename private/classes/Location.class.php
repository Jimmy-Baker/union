<?php

class Location extends DatabaseObject {

  static protected $table_name = "locations";
  static protected $db_columns = ['id', 'gym_id', 'location_name', 'street_address', 'city', 'zip', 'state_abv', 'country_abv', 'phone_p_country', 'phone_primary', 'photo_data', 'capacity', 'employee_group'];
  
  public $id;
  public $gym_id;
  public $location_name;
  public $street_address;
  public $city;
  public $zip;
  public $state_abv;
  public $country_abv;
  public $phone_p_country;
  public $phone_primary;
  public $photo_data = [];
  public $capacity;
  public $employee_group;
  
  /** 
   * Constructs a Location object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated location
   */
  public function __construct($args=[]) {
    $this->gym_id = $args['gym_id'] ?? '';
    $this->location_name = $args['location_name'] ?? '';
    $this->street_address = $args['street_address'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->zip = $args['zip'] ?? '';
    $this->state_abv = $args['state_abv'] ?? '';
    $this->country_abv = $args['country_abv'] ?? '';
    $this->phone_p_country = $args['phone_p_country'] ?? '';
    $this->phone_primary = $args['phone_primary'] ?? '';
    $this->photo_data = $args['photo_data'] ?? [];
    $this->capacity = $args['capacity'] ?? '';
    $this->employee_group = $args['employee_group'] ?? '';
  }
  
  /** 
   * Returns the number of occupants at the location
   * 
   * @return int The number of occupants 
   */
  public function occupants() {
    return Attendance::current_count($this->id);
  }
  
  /** 
   * Returns the number of available spaces for checkin at the location
   * 
   * @return number The number of available spaces 
   */
  public function available() {
    return ($this->capacity - $this->occupants());
  }
  
  /** 
   * Concatenates the location and gym names
   *  
   * @param string $sep The string to join with, ex. ' - ' 
   * @return string The concatenated names and seperator string 
   */
  public function full_name($sep = null) {
    $gym_name = Gym::return_param_by_id("gym_name", $this->gym_id);
    if(isset($sep)){
      return $gym_name . ' ' . $sep . ' ' . $this->location_name;
    } else {
      return $gym_name . ' ' . $this->location_name;
    }
  }
  
  /** 
   * Retrieves all locations as objects with additional properties
   * 
   * @return array An array of expanded location objects 
   */
  static public function find_all_locations_expanded() {
    $sql = "SELECT locations.*, states.state_name, states.region, gyms.gym_name, gyms.website FROM locations INNER JOIN states ON locations.state_abv=states.abv INNER JOIN gyms ON locations.gym_id=gyms.id;";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
      // foreach($object as $prop=>$value){
      //   $value = $value;
      // }
      $array[] = $object;
    }
    $results->free();
    return $array; 
  }
  
  /** 
   * Retrieves a single location at random as an object with additional properties
   *   
   * @return object A Location with additional properties
   */
  static public function find_random_expanded() {
    $sql = "SELECT * FROM (SELECT locations.*, states.state_name, states.region, gyms.gym_name, gyms.website, gyms.avatar_url FROM locations INNER JOIN states ON locations.state_abv=states.abv INNER JOIN gyms ON locations.gym_id=gyms.id) AS r1 JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM locations)) AS id) AS r2 WHERE r1.id >= r2.id ORDER BY r1.id ASC LIMIT 1;";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
      // foreach($object as $prop=>$value){
      //   $value = h($value);
      // }
      $array[] = $object;
    }
    $results->free();
    return array_shift($array);
  }
  
  /** 
   * Retrieves a single location as an object with additional properties 
   * 
   * @param string $id The id of the location to retrieve 
   * @return object A Location with additional properties 
   */
  static public function find_expanded_by_id($id) {
    $sql = "SELECT locations.*, states.state_name, states.region, gyms.gym_name, gyms.website FROM locations INNER JOIN states ON locations.state_abv=states.abv INNER JOIN gyms ON locations.gym_id=gyms.id WHERE locations.id='" . parent::$database->escape_string($id) . "';";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
      // foreach($object as $prop=>$value){
      //   $value = $value;
      // }
      $array[] = $object;
    }
    $results->free();
    return array_shift($array); 
  }
  
  /** 
   * Tests Location properties for valid HTML input values
   *
   * @return array HTML elements as keys and messages as values 
   */
  protected function validate() {
    $this-> error_array = [];
    
    if(is_blank($this->location_name)) {
      $this->error_array += ["LocationName" => "Location name cannot be blank."];
    } elseif (!has_length($this->location_name, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["LocationName" => "Location name must be less than 32 characters."];
    } elseif (has_padding($this->location_name)) {
      $this->error_array += ["LocationName" => "Location name cannot start or end with a space."];
    } elseif (!has_valid_name($this->location_name)) {
      $this->error_array += ["LocationName" => "Location name can only contain letters, dashes, and spaces."];
    }
        
    if(is_blank($this->gym_id)) {
      $this->gym_id += ["GymId" => "Gym ID must be selected."];
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
    } elseif (!has_length($this->password, array('min'=>2, 'max'=>64))) {
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
    
    if(is_blank($this->phone_primary)) {
      $this->error_array += ["PhonePrimary" => "Primary phone cannot be blank."];
    } elseif (!ctype_digit($this->phone_primary)) {
      $this->error_array += ["PhonePrimary" => "Primary phone can only contain numerals."];
    } elseif (!has_length($this->phone_primary, array('min' => 10, 'max'=>12))) {
      $this->error_array += ["PhonePrimary" => "Primary phone must be 10 to 12 digits."];
    }

    return $this->error_array;      
  }
  
}