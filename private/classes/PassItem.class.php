<?php

class PassItem extends DatabaseObject {

  static protected $table_name = "pass_line_items";
  static protected $db_columns = ['pass_id', 'gym_id', 'assigned', 'used'];
  
  public $pass_id;
  public $gym_id;
  public $assigned;
  public $used;
  
  /** 
   * Constructs a PassItem object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated pass item
   */
  public function __construct($args=[]) {
    $this->pass_id = $args['pass_id'] ?? '';
    $this->gym_id = $args['gym_id'] ?? '';
    $this->assigned = $args['assigned'] ?? '';
    $this->used = $args['used'] ?? '';
  }
  
  /** 
   * Determines how many visits are remaining for the PassItem
   *
   * @return int Total visits remaining 
   */
  public function available() {
    return ($this->assigned - $this->used);
  }
  
  /** 
   * Returns an array of PassItem objects for a specific pass
   *  
   * @param string $pass_id The pass to find items for 
   * @returns array An array of PassItem objects 
   */
  static public function find_by_pass($pass_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE pass_id='" . self::$database->escape_string($pass_id) . "'";
    return static::find_by_sql($sql);
  }
  
  /** 
   * Delivers the PassItem correlating to a specific pass and gym 
   * 
   * @param string $pass_id The pass to search within
   * @param string $gym_id The gym to select for
   * @returns object A single PassItem object 
   */
  static public function find_by_pass_and_gym($pass_id, $gym_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE pass_id='" . self::$database->escape_string($pass_id) . "' ";
    $sql .= "AND gym_id='" . self::$database->escape_string($gym_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  /** 
   * Validates PassItem property values before creating a database record  
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
    return $result;
  }

  /** 
   * Validates PassItem property values before updating a database record  
   * 
   * @return boolean ex. True if record was updated sucessfully
   */
  protected function update() {
    $this->validate();
    if(!empty($this->error_array)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}=".quote_null($value);
    }
    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE pass_id='" . self::$database->escape_string($this->pass_id) . "' ";
    $sql .= "AND gym_id='" . self::$database->escape_string($this->gym_id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }
  
  /** 
   * Determines whether a PassItem record exists and updates or creates a record 
   * 
   * @return boolean ex. True if record was created sucessfully
   */
  public function save() {
    // A new record will not have an ID yet
    if(isset($this->pass_id) && isset($this->gym_id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }
  
  /** 
   * Updates a PassItem database record with an additional used pass
   * 
   * @return boolean ex. True if record was updated sucessfully
   */
  public function redeem_punch() {
    if($this->available()>0){
      $this->used += 1;
      $result = $this->save();
      return $result;
    } else {
      return false;
    }
  }
  
  /** 
   * Updates a PassItem database record with one less used pass
   * 
   * @return boolean ex. True if record was updated sucessfully
   */
  public function refund_punch() {
    if($this->used>0){
      $this->used -= 1;
      $result = $this->save();
      return $result;
    } else {
      return false;
    }
  }
  
  /** 
   * Deletes all PassItem records for a given pass_id
   *  
   * @param string $id The pass_id to process 
   * @return boolean ex. False if the delete failed 
   */
  public static function delete_all($id) {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE pass_id='" . self::$database->escape_string($id) . "' ";
    $result = self::$database->query($sql);
    return $result;
  }
}