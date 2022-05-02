<?php

class State extends DatabaseObject {

  static protected $table_name = "states";
  static protected $db_columns = ['abv', 'state_name', 'region'];
  
  public $abv;
  public $state_name;
  public $region;
  
  /** 
   * Constructs a State object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated state
   */
  public function __construct($args=[]) {
    $this->abv = $args['abv'] ?? '';
    $this->state_name = $args['state_name'] ?? '';
  }
  
  /** 
   * Provides a list of all States and their properties 
   * 
   * @return array An array of State objects
   */
  static public function all_states() {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " ORDER BY `state_name`";
    return static::find_by_sql($sql);
  }
}