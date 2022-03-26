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
  
}
