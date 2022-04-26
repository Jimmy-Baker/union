<?php

class PassItem extends DatabaseObject {

  static protected $table_name = "pass_line_items";
  static protected $db_columns = ['pass_id', 'gym_id', 'assigned', 'used'];
  
  public $pass_id;
  public $gym_id;
  public $assigned;
  public $used;
  
  public function __construct($args=[]) {
    $this->pass_id = $args['pass_id'] ?? '';
    $this->gym_id = $args['gym_id'] ?? '';
    $this->assigned = $args['assigned'] ?? '';
    $this->used = $args['used'] ?? '';
  }
  
  public function available() {
    return ($this->assigned - $this->used);
  }
  
  public function is_available() {
    if($this->available > 0) {
      return true;
    } else {
      return false;
    }
  }
  
  static public function find_by_pass($pass_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE pass_id='" . self::$database->escape_string($pass_id) . "'";
    return static::find_by_sql($sql);
  }
  
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
  
  public function save() {
    // A new record will not have an ID yet
    if(isset($this->pass_id) && isset($this->gym_id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }
  
  public function redeem_punch() {
    $this->used = 1;
    $result = $this->save();
    return $result;
  }
  
  public static function delete_all($id) {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE pass_id='" . self::$database->escape_string($id) . "' ";
    $result = self::$database->query($sql);
    return $result;
  }
}