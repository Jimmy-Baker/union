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
  public $photo_data;
  public $attendance_data;
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
    $this->photo_data = $args['photo_data'] ?? '';
    $this->attendance_data = $args['attendance_data'] ?? '';
    $this->capacity = $args['capacity'] ?? '';
  }
  
  public function occupants() {
    return jnc($this->attendance_data);
  }
  
  public function available() {
    return ($this->capacity - jnc($this->attendance_data));
  }
  
}
