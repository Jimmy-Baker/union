<?php

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $db_columns = [];
  public $error_array = [];

  /** 
   * Sets the database property with an active mysqli object 
   * 
   * @param mysqli $database An active mysqli object  
   */
  static public function set_database($database) {
    self::$database = $database;
  }

  /** 
   * Queries the database and instaniates the resulting records as objects within an array
   *  
   * @param string $sql A MySQL statement to query the database with
   * @return array An array of instantiated objects 
   */
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }
    $result->free();
    return $object_array;
  }

  /** 
   * Retrieves all records from the class's table as objects 
   *
   * @return array An array of records as objects
   */
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  /** 
   * Retrieves a single record from the class's table as an object
   * 
   * @param string $id The id to identify the record by
   * @return object/boolean A class object or False 
   */
  static public function find_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  /** 
   * Retrieves a single record at randomfrom the class's table as an object
   * 
   * @return object/boolean A class object or False 
   */
  static public function find_one_random() {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " AS r1 JOIN (SELECT CEIL(RAND() *";
    $sql .= " (SELECT MAX(id) FROM " . static::$table_name . ")) AS id) AS r2";
    $sql .= " WHERE r1.id >= r2.id ORDER BY r1.id ASC LIMIT 1;";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  /** 
   * Retrieves a single record meeting given criteria from the class's table as an object
   * 
   * @param string $param The field to identify the record by
   * @param string $value The value for the given field
   * @return object/boolean A class object or False 
   */
  static public function find_by_param($param, $value){
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE " . self::$database->escape_string($param) . "='" . self::$database->escape_string($value) . "' LIMIT 1";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  /** 
   * Retrieves all records meeting given criteria from the class's table as an object
   * 
   * @param string $param The field to identify the record by
   * @param string $value The value for the given field
   * @return array An array of class objects
   */
  static public function find_all_by_param($param, $value){
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE " . self::$database->escape_string($param) . "='" . self::$database->escape_string($value) . "'";
    return static::find_by_sql($sql);
  }
  
  /** 
   * Retrieves a single field value for a specific record
   *  
   * @param string $param The field to retrieve
   * @param string $id The id of the record to retrieve
   * @return string The field value for the record 
   */
  static public function return_param_by_id($param, $id) {
    $sql = "SELECT " . self::$database->escape_string($param) . " FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array)->$param;
    } else {
      return false;
    }
  }

  /** 
   * Converts a retrieved record into a an object with the fields as properties
   *  
   * @param array $record The record to proccess 
   * @return object The instantiated object 
   */
  static protected function instantiate($record) {
    $object = new static;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $value = isJSON($value) ? json_decode($value) : $value;
        $object->$property = $value;
      }
    }
    return $object;
  }

  /** 
   * Tests User properties for valid HTML input values
   *
   * @return array HTML elements as keys and messages as values 
   */
  protected function validate() {
    $this->error_array = [];
    return $this->error_array;
  }

  /** 
   * Creates a database record from the object  
   * 
   * @return boolean ex. True if record was created sucessfully
   */
  protected function create() {
    $this->validate();
    if(!empty($this->error_array)) { return false; }
    
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES (";
    $prepared_attributes = array_map('quote_null', array_values($attributes));
    $sql .= join(", ", $prepared_attributes);
    $sql .= ") LIMIT 1;";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  /** 
   * Updates a database record with the object's property values
   * 
   * @return boolean ex. True if record was created sucessfully
   */
  protected function update() {
    $this->validate();
    if(!empty($this->error_array)) { 
      return false;
    }
    
    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}=".quote_null($value);
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  /** 
   * Creates or updates a database record  
   * 
   * @return boolean ex. True if record was created sucessfully
   */
  public function save() {
    // A new record will not have an ID yet
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  /** 
   * Updates an object's properties with values from an associative array  
   * 
   * @param array $args An array of values to update the object with
   * @return boolean ex. True if record was created sucessfully
   */
  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  /** 
   * Returns the object's properties as represented in the class table
   *   
   * @return array An array of object properties 
   */
  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  /** 
   * Maps over an attribute array to escape special characters
   * 
   * @return array An array of attributes 
   */
  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $value = is_array($value) ? json_encode($value) : $value;
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  /** 
   * Removes a specific record from the class table 
   *
   * @return boolean ex. True if the delete was succesful 
   */
  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }
}

?>