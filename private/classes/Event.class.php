<?php

class Event extends DatabaseObject {

  static protected $table_name = "events";
  static protected $db_columns = ['id', 'start_date', 'end_date', 'location_id', 'event_name', 'participants', 'cost', 'url', 'photo_data', 'description'];
  
  public $id;
  public $start_date;
  public $end_date;
  public $location_id;
  public $event_name;
  public $participants;
  public $cost;
  public $url;
  public $photo_data = [];
  public $description;
  
  /** 
   * Constructs a Event object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated event
   */
  public function __construct($args=[]) {
    $this->start_date = $args['start_date'] ?? '';
    $this->end_date = $args['end_date'] ?? '';
    $this->location_id = $args['location_id'] ?? '';
    $this->event_name = $args['event_name'] ?? '';
    $this->participants = $args['participants'] ?? '';
    $this->cost = $args['cost'] ?? '';
    $this->url = $args['url'] ?? '';
    $this->photo_data = $args['photo_data'] ?? '"/public/upload/event/default.png"';
    $this->description = $args['description'] ?? '';
  }
  
  /** 
   * Retrieves an array of events occuring this month with expanded properties
   *  
   * @return array An array of Event objects 
   */
  public static function find_ex_this_month() {
    $sql = "SELECT events.*, b.location_name, b.gym_name from events LEFT JOIN (SELECT locations.id AS id, locations.location_name AS location_name, gyms.gym_name AS gym_name FROM locations LEFT JOIN gyms ON locations.gym_id = gyms.id) AS b ON events.location_id=b.id WHERE events.start_date >= (LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 1 MONTH) AND events.start_date < (LAST_DAY(NOW()) + INTERVAL 1 DAY) ORDER BY start_date ASC;";
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
   * Retrieves an array of events occuring next month with expanded properties
   *  
   * @return array An array of Event objects 
   */
  public static function find_ex_next_month() {
    $sql = "SELECT events.*, b.location_name, b.gym_name from events LEFT JOIN (SELECT locations.id AS id, locations.location_name AS location_name, gyms.gym_name AS gym_name FROM locations LEFT JOIN gyms ON locations.gym_id = gyms.id) AS b ON events.location_id=b.id WHERE events.start_date >= (LAST_DAY(NOW()+INTERVAL 1 MONTH) + INTERVAL 1 DAY - INTERVAL 1 MONTH) AND events.start_date < (LAST_DAY(NOW() + INTERVAL 1 MONTH) + INTERVAL 1 DAY) ORDER BY start_date ASC;";
    return parent::find_by_sql($sql);
  }
  
  /** 
   * Tests User properties for valid HTML input values
   *
   * @return array HTML elements as keys and messages as values 
   */
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->start_date)) {
      $this->error_array += ["StartDate" => "Start date cannot be blank."];
    } elseif (!has_date($this->start_date, array('min' => 'now'))) {
      $this->error_array += ["StartDate" => "Cannot be a past date."];
    }

    if(is_blank($this->end_date)) {
      $this->error_array += ["EndDate" => "End date cannot be blank."];
    } elseif (!has_date($this->end_date, array('min' => 'now'))) {
      $this->error_array += ["EndDate" => "Cannot be a past date."];
    } elseif (!has_date($this->end_date, array('min' => $this->start_date))) {
      $this->error_array += ["EndDate" => "Cannot be before the start date."];
    }
    
    if(is_blank($this->location_id)) {
      $this->error_array += ["LocationID" => "Location cannot be blank."];
    } elseif (!ctype_digit($this->location_id)) {
      $this->error_array += ["LocationID" => "Location can only contain numerals."];
    } elseif (!has_length($this->location_id, array('min' => 1, 'max' => 5))) {
      $this->error_array += ["LocationID" => "Location must be 5 digits or less."];
    }

    if(is_blank($this->event_name)) {
      $this->error_array += ["EventName" => "Event name cannot be blank."];
    } elseif (!has_length($this->event_name, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["EventName" => "Event name must be less than 32 characters."];
    } elseif (has_padding($this->event_name)) {
      $this->error_array += ["EventName" => "Event name cannot start or end with a space."];
    } elseif (!has_valid_name($this->event_name)) {
      $this->error_array += ["EventName" => "Event name can only contain letters, dashes, and spaces."];
    }
    
    if(is_blank($this->participants)) {
      $this->error_array += ["Participants" => "Participants cannot be blank."];
    } elseif (!ctype_digit($this->participants)) {
      $this->error_array += ["Participants" => "Participants can only contain numerals."];
    } elseif (!has_length($this->participants, array('min' => 1, 'max' => 5))) {
      $this->error_array += ["Participants" => "Participants must be 3 digits or less."];
    }
    
    if(!isset($this->cost)) {
      $this->error_array += ["Cost" => "Cost cannot be blank."];
    } elseif (!ctype_digit($this->cost) &&!has_decimal_format($this->cost)) {
      $this->error_array += ["Cost" => "Cost must be a decimal number."];
    }

    if(isset($this->url) && $this->url!=''){
      if(!has_valid_url($this->url)) {
        $this->error_array += ["URL" => "URL must be a valid URL format."];
      }
    }
    
    if(isset($this->description) && $this->description!=''){
      if(!ctype_print($this->description)) {
        $this->error_array += ["description" => "Description must consist of printable characters."];
      } elseif(has_padding($this->description)){
        $this->error_array += ["description" => "Description cannot begin or end with spaces."];
      } elseif(!has_valid_text($this->description)) {
        $this->error_array += ["description" => "Description cannot contain any special characters."];
      }
    }
    
    return $this->error_array;
  }
  
}