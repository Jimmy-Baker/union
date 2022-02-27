<?php

class State extends DatabaseObject {

  static protected $table_name = "states";
  static protected $db_columns = ['abv', 'state_name'];
  
  public $abv;
  public $state_name;
  
  public function __construct($args=[]) {
    $this->abv = $args['abv'] ?? '';
    $this->state_name = $args['state_name'] ?? '';
  }
  
  static public function all_states() {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " ORDER BY `state_name`";
    return static::find_by_sql($sql);
  }
}