<?php

class GroupType extends DatabaseObject {

  static protected $table_name = "group_types";
  static protected $db_columns = ['abv', 'description'];
  
  public $abv;
  public $description;
  
  public function __construct($args=[]) {
    $this->abv = $args['abv'] ?? '';
    $this->description = $args['description'] ?? '';
  }
  
}