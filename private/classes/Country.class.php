<?php

class Country extends DatabaseObject {

  static protected $table_name = "countries";
  static protected $db_columns = ['abv', 'country_name', 'country_prefix'];
  
  public $abv;
  public $country_name;
  public $country_prefix;
  
  /** 
   * Constructs a Country object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated country
   */
  public function __construct($args=[]) {
    $this->abv = $args['abv'] ?? '';
    $this->country_name = $args['country_name'] ?? '';
    $this->country_prefix = $args['country_prefix'] ?? '';
  }
  
  /** 
   * Retrieves an array of all countries as objects
   *
   * @return array An array of all countries 
   */
  static public function all_countries() {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " ORDER BY `country_name`";
    return static::find_by_sql($sql);
  }
}