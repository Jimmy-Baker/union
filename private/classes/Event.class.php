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
  public $photo_data;
  
  public function __construct($args=[]) {
    $this->start_date = $args['start_date'] ?? '';
    $this->end_date = $args['end_date'] ?? '';
    $this->location_id = $args['location_id'] ?? '';
    $this->event_name = $args['event_name'] ?? '';
    $this->participants = $args['participants'] ?? '';
    $this->cost = $args['cost'] ?? '';
    $this->url = $args['url'] ?? '';
    $this->photo_data = $args['photo_data'] ?? '';
  }
  
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->start_date)) {
      $this->error_array[] = ["#inputStartDate", "First name cannot be blank."];
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
  
}