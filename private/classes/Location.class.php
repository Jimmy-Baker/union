<?php

class Location extends DatabaseObject {

  static protected $table_name = "locations";
  static protected $db_columns = ['id', 'gym_id', 'location_name', 'street_address', 'city', 'zip', 'state_abv', 'country_abv', 'phone_primary', 'photo_data', 'attendance_data', 'capacity'];
  
  public $id;
  public $gym_id;
  public $location_name;
  public $street_address;
  public $city;
  public $zip;
  public $state_abv;
  public $country_abv;
  public $phone_primary;
  public $photo_data = [];
  public $attendance_data = [];
  public $capacity;
  
  public function __construct($args=[]) {
    $this->gym_id = $args['gym_id'] ?? '';
    $this->location_name = $args['location_name'] ?? '';
    $this->street_address = $args['street_address'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->zip = $args['zip'] ?? '';
    $this->state_abv = $args['state_abv'] ?? '';
    $this->country_abv = $args['country_abv'] ?? '';
    $this->phone_primary = $args['phone_primary'] ?? '';
    $this->photo_data = $args['photo_data'] ?? [];
    $this->attendance_data = $args['attendance_data'] ?? [];
    $this->capacity = $args['capacity'] ?? '';
  }
  
  public function occupants() {
    return Attendance::currently_in($this->id);
  }
  
  public function available() {
    return ($this->capacity - $this->occupants());
  }
  
  public function full_name($sep = null) {
    $gym_name = Gym::return_param_by_id("gym_name", $this->gym_id);
    if(isset($sep)){
      return $gym_name . ' ' . $sep . ' ' . $this->location_name;
    } else {
      return $gym_name . ' ' . $this->location_name;
    }
  }
  
  static public function array_all_both_names() {
    $sql = "SELECT locations.id, gyms.gym_name, locations.location_name FROM " . static::$table_name;
    $sql .= " INNER JOIN gyms ON locations.gym_id=gyms.id;";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $array[] = $record;
    }
    return $array;   
  }
  
  // public function check_in($user) { 
  //   $item = array("id"=>$user->id, "name"=>$user->full_name(), "in"=>timestamp(), "out"=>null);
  //   $this->attendance_data[] = $item;
  //   $result = $this->save();
  //   return $result;
  // } 
  
}