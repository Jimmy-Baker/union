<?php

class GroupType extends DatabaseObject {

  static protected $table_name = "group_types";
  static protected $db_columns = ['abv', 'description'];
  
  public $abv;
  public $description;
  
  /** 
   * Constructs a GroupType object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated group type
   */
  public function __construct($args=[]) {
    $this->abv = $args['abv'] ?? '';
    $this->description = $args['description'] ?? '';
  }
  
}