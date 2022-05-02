<?php

class Attendance extends DatabaseObject {

  static protected $table_name = "attendance";
  static protected $db_columns = ['id', 'user_id', 'location_id', 'time_in', 'time_out'];
  
  public $id;
  public $user_id;
  public $location_id;
  public $time_in;
  public $time_out;
  
  /** 
   * Constructs an Attendance object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated attendance object
   */
  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->location_id = $args['location_id'] ?? '';
    $this->time_in = $args['time_in'] ?? '';
    $this->time_out = $args['time_out'] ?? '';
  }
  
  /** 
   * Adds a user to the attendance table 
   *
   * @param string $user_id The user to check in 
   * @param string $location_id The location to check in at
   * @return boolean ex. False if the query failed 
   */
  static public function check_in($user_id, $location_id) {
    $sql = "INSERT INTO " . static::$table_name;
    $sql .= " (user_id, location_id, time_in)";
    $sql .= " VALUES (" . quote_null($user_id) . ", ";
    $sql .= quote_null($location_id) . ", NOW() ) LIMIT 1;";
    return self::$database->query($sql);
  }
  
  /** 
   * Retrieves the record where a user checked in at a given location
   *  
   * @param string $user_id The user to search for 
   * @param string $location_id The location to search within
   * @return object The attendance object containing the checkin
   */
  static public function find_in($user_id, $location_id) {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE user_id=" . quote_null($user_id);
    $sql .= " AND location_id=" . quote_null($location_id);
    $sql .= " AND time_in >= CURDATE() AND time_in < (CURDATE() + INTERVAL 1 DAY)";
    $sql .= " AND time_out IS NULL";
    $sql .= " ORDER BY time_in ASC LIMIT 1";
    $result = static::find_by_sql($sql);
    return array_shift($result);
  }
  
  /** 
   * Determines whether a user is checked into a location
   *  
   * @param string $user_id The user to evaluate 
   * @param string $location_id The location to evaluate
   * @return boolean ex. True if the user is checked in 
   */
  static public function check_status($user_id, $location_id) {
    $status = static::find_in($user_id, $location_id);
    if($status) {
      return true;
    } else {
      return false;
    }
  }
  
  /** 
   * Checks a user out from an attendance record
   *
   * @return boolean ex. True if the query was successful 
   */
  public function check_out() {
    $sql = "UPDATE " . static::$table_name;
    $sql .=  " SET time_out = NOW()";
    $sql .= " WHERE id=" . self::$database->escape_string($this->id);
    $sql .= " LIMIT 1";
    return self::$database->query($sql);
  }
  
  /** 
   * Returns the count of users checked in to a location
   *  
   * @param string $location_id The location to count users in 
   * @return int The number of users currently checked in 
   */
  static public function current_count($location_id) {
    $sql = "SELECT id FROM " . static::$table_name;
    $sql .= " WHERE location_id=" . quote_null($location_id);
    $sql .= " AND time_out IS NULL";
    $result = static::find_by_sql($sql);
    return count($result);
  }
  
  /** 
   * Returns an array of attendance records for the curernt day 
   * 
   * @param string $location_id The location to evaluate 
   * @return array An array of Attendance objects
   */
  static public function today_list_expanded($location_id) {
    $sql = "SELECT attendance.*, users.first_name, users.preferred_name, users.last_name FROM attendance INNER JOIN users ON attendance.user_id=users.id WHERE location_id='" . parent::$database->escape_string($location_id);
    $sql .= "' AND time_in >= CURDATE() AND time_in < (CURDATE() + INTERVAL 1 DAY) ORDER BY time_in ASC;";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
      $array[] = $object;
    }
    $results->free();
    return $array;
  }
  
}