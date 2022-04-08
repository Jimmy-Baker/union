<?php

class Attendance extends DatabaseObject {

  static protected $table_name = "attendance";
  static protected $db_columns = ['id', 'user_id', 'location_id', 'time_in', 'time_out'];
  
  public $id;
  public $user_id;
  public $location_id;
  public $time_in;
  public $time_out;
  
  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->location_id = $args['location_id'] ?? '';
    $this->time_in = $args['time_in'] ?? '';
    $this->time_out = $args['time_out'] ?? '';
  }
  
  static public function clock_in($user_id, $location_id) {
    $sql = "INSERT INTO " . static::$table_name;
    $sql .= " (user_id, location_id, time_in)";
    $sql .= " VALUES (" . quote_null($user_id) . ", ";
    $sql .= quote_null($location_id) . ", NOW() )";
    return self::$database->query($sql);
  }
  
  static public function find_in($user_id, $location_id) {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE user_id=" . quote_null($user_id);
    $sql .= " AND location_id=" . quote_null($location_id);
    $sql .= " AND time_out IS NULL";
    $sql .= " ORDER BY time_in ASC LIMIT 1";
    $result = static::find_by_sql($sql);
    return array_shift($result);
  }
  
  static public function check_status($user_id, $location_id) {
    $status = static::find_in($user_id, $location_id);
    if($status) {
      return true;
    } else {
      return false;
    }
  }
  
  public function clock_out() {
    $sql = "UPDATE " . static::$table_name;
    $sql .=  " SET time_out = NOW()";
    $sql .= " WHERE id=" . self::$database->escape_string($this->id);
    $sql .= " LIMIT 1";
    return self::$database->query($sql);
  }
  
  static public function currently_in($location_id) {
    $sql = "SELECT id FROM " . static::$table_name;
    $sql .= " WHERE location_id=" . quote_null($location_id);
    $sql .= " AND time_out IS NULL";
    $result = static::find_by_sql($sql);
    return count($result);
  }
}