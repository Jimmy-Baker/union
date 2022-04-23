<?php

class Event extends DatabaseObject {

  static protected $table_name = "events";
  static protected $db_columns = ['id', 'start_date', 'end_date', 'location_id', 'event_name', 'participants', 'cost', 'url', 'photo_data'];
  
  public $id;
  public $start_date;
  public $end_date;
  public $location_id;
  public $event_name;
  public $participants;
  public $cost;
  public $url;
  public $photo_data = [];
  
  public function __construct($args=[]) {
    $this->start_date = $args['start_date'] ?? '';
    $this->end_date = $args['end_date'] ?? '';
    $this->location_id = $args['location_id'] ?? '';
    $this->event_name = $args['event_name'] ?? '';
    $this->participants = $args['participants'] ?? '';
    $this->cost = $args['cost'] ?? '';
    $this->url = $args['url'] ?? '';
    $this->photo_data = $args['photo_data'] ?? [];
  }
  
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
    } elseif (!ctype_digit($this->zip)) {
      $this->error_array += ["LocationID" => "Location can only contain numerals."];
    } elseif (!has_length($this->zip, array('min' => 1, 'max' => 5))) {
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
    } elseif (!ctype_digit($this->zip)) {
      $this->error_array += ["Participants" => "Participants can only contain numerals."];
    } elseif (!has_length($this->zip, array('min' => 1, 'max' => 5))) {
      $this->error_array += ["Participants" => "Participants must be 3 digits or less."];
    }
    
    if(!isset($this->cost)) {
      $this->error_array += ["Cost" => "Cost cannot be blank."];
    } elseif (!has_decimal_format($this->cost)) {
      $this->error_array += ["Cost" => "Cost must be a decimal number."];
    }

    if(isset($this->url)){
      if(!has_valid_url($this->url)) {
        $this->error_array += ["URL" => "URL must be a valid URL format."];
      }
    }
    
    
    
    return $this->error_array;
  }
  
}