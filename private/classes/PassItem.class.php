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
  
  public function redeem_punch() {
    $this->used = $this->used + 1;
    $this->save();
  }
  
}