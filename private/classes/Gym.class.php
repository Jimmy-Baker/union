<?php

class Gym extends DatabaseObject {

  static protected $table_name = "gyms";
  static protected $db_columns = ['id', 'gym_name', 'website', 'avatar_url'];
  
  public $id;
  public $gym_name;
  public $website;
  public $avatar_url;
  
  public function __construct($args=[]) {
    $this->gym_name = $args['gym_name'] ?? '';
    $this->website = $args['website'] ?? '';
    $this->avatar_url = $args['avatar_url'] ?? '';
  }
  
  protected function validate() {
    $this->error_array = [];
    
    if(is_blank($this->gym_name)) {
      $this->error_array += ["GymName" => "Gym name cannot be blank."];
    } elseif (!has_length($this->gym_name, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["GymName" => "Gym name must be less than 32 characters."];
    } elseif (has_padding($this->gym_name)) {
      $this->error_array += ["GymName" => "Gym name cannot start or end with a space."];
    } elseif (!has_valid_name($this->gym_name)) {
      $this->error_array += ["GymName" => "Gym name can only contain letters, dashes, and spaces."];
    }
    
    if(!is_blank($this->website)) {
      if(!has_valid_url($this->website)) {
        $this->error_array += ["Website" => "Website must be a valid URL."];
      }
    }
    
  }
  
}