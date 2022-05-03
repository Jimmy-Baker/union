<?php

class Pass extends DatabaseObject {

  static protected $table_name = "passes";
  static protected $db_columns = ['id', 'user_id', 'is_active', 'pass_type', 'created_at', 'active_on', 'expires_on'];
  
  public $id;
  public $user_id;
  public $is_active;
  public $pass_type;
  public $created_at;
  public $active_on;
  public $expires_on;
  
  public const PASS_TYPES = ['A'=>'Administrator','B'=>'Unlimited', 'C'=>'Conditional','D'=>'Base Pass', 'E'=>'Union Pass', 'F'=>'Season Pass'];
  
  /** 
   * Constructs a Pass object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated pass
   */
  public function __construct($args=[]) {
    $this->user_id = $args['user_id'] ?? '';
    $this->is_active = $args['is_active'] ?? '';
    $this->pass_type = $args['pass_type'] ?? '';
    $this->created_at = $args['created_at'] ?? '';
    $this->active_on = $args['active_on'] ?? '';
    $this->expires_on = $args['expires_on'] ?? '';
  }
  
  /** 
   * Provides a long-form pass type based on a Pass's pass_type
   * 
   * @return string ex. Union Pass or Season Pass 
   */
  public function pass_type() {
    $key = $this->pass_type;
    return self::PASS_TYPES[$key];
  }
  
  /** 
   * Tests whether or not a pass is currently active
   * 
   * @return string ex. Yes if pass is active 
   */
  public function is_active() {
    return ($this->is_active == "1") ? 'Yes' : 'No';
  }
  
  /** 
   * Retrieves an array of all expired passes
   *
   * @return array An array of Pass objects
   */
  static public function find_expired(){
    $today = date('Y-m-d');
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expires_on > '" . $today . "'";
    return static::find_by_sql($sql);
  }  
  
  /** 
   * Retrieves an array of all active passes  
   *
   * @return array An array of Pass objects 
   */
  static public function find_active(){
    $today = date('Y-m-d');
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expires_on < '" . $today . "'";
    return static::find_by_sql($sql);
  }  
  
  /** 
   * Activates a Pass, sets an expiration date, and updates the database record 
   *
   * @return boolean ex. True if record update was successful
   */
  public function activate() {
    $today = date('Y-m-d');
    $this->active_on = $today; 
    $this->is_active = 1;
    switch ($this->pass_type) {
      case "A": $this->expires_on = date('Y-m-d', strtotime($today . ' + 365 days'));; break;
      case "B": $this->expires_on = date('Y-m-d', strtotime($today . ' + 365 days'));; break;
      case "C": $this->expires_on = date('Y-m-d', strtotime($today . ' + 1 month'));; break;
      case "D": $this->expires_on = date('Y-m-d', strtotime($today . ' + 1 month'));; break;
      case "E": $this->expires_on = date('Y-m-d', strtotime($today . ' + 1 month'));; break;
      case "F": $this->expires_on = date('Y-m-d', strtotime($today . ' + 3 months'));; break;
    }
    return $this->save();
  }
  
  /** 
   * Deactivates all other passes with a matching user_id and updates their records
   *
   * @return boolean ex. True if the update was successful
   */
  public function deactive_others() {
    $sql = "UPDATE passes SET is_active=0 WHERE user_id='" . $this->user_id . "' AND id<>'" . $this->id . "';";
    $result = self::$database->query($sql);
    return $result;
  }
  
  /** 
   * Populates the database with PassItems for the Pass 
   *
   * @return boolean ex. True if the record insertion was successful 
   */
  public function provision() {
    $query = "SELECT id FROM gyms";
    $results = self::$database->query($query);
    $gyms = [];
    while($record = $results->fetch_row()){
      $gyms[] = $record[0];
    }
    $results->free();

    switch($this->pass_type) {
      case "A": $assigned=30; break;
      case "B": $assigned=99; break;
      case "C": $assigned=10; break;
      case "D": $assigned=1; break;
      case "E": $assigned=3; break;
      case "F": $assigned=5; break;
    }
    
    $sql = "INSERT INTO pass_line_items (pass_id, gym_id, assigned) VALUES";
    foreach($gyms as $gym){
      $sql .= " ('" . $this->id . "', '" . $gym . "', '" . $assigned . "'),";
    }
    $sql = substr($sql, 0, -1) . ";";
    $result = self::$database->query($sql);

    return $result;
  }
  
  /** 
   * Tests Pass properties for valid HTML input values
   *
   * @return array HTML elements as keys and messages as values
   */
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->user_id)) {
      $this->error_array[] = ["UserID" => "User ID cannot be blank."];
    } elseif(!ctype_alnum($this->user_id)){
      $this->error_array[] = ["UserID" => "User ID must be a number."];
    }
    
    if($this->is_active != 0 && $this->is_active != 1) {
      $this->error_array[] = ["IsActive" => "Possible values are limited to Yes or No."];
    }
    
    if(is_blank($this->pass_type)) {
      $this->error_array[] = ["PassType" => "Pass type cannot be blank."];
    } elseif(!isset(PASS::PASS_TYPES[$this->pass_type])){
      $this->error_array[] = ["PassType" => "Pass type values are limited to pre-defined values."];
    }
    
    if(!is_blank($this->created_at)) {
      if(!has_date($this->created_at, array('max' => 'now'))){
      $this->error_array[] = ["CreatedAt" => "Cannot be a future date."];
      }
    }
    
    if(!is_blank($this->active_on)) {
      if(!has_date($this->active_on, array('min' => 'now'))){
      $this->error_array[] = ["ActiveOn" => "Cannot be a past date."];
      }
    }    
    
    if(!is_blank($this->expires_on)) {
      if(!has_date($this->expires_on, array('min' => 'now'))){
      $this->error_array[] = ["ExpiresOn" => "Cannot be a past date."];
      }
    }

    return $this->error_array;
  } 
  
  /** 
   * Retrieves a single active Pass for a given user
   *  
   * @param string $user_id The user to find a pass for
   * @return object/boolen An instantiated Pass or False 
   */
  static public function find_users_active_pass($user_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . $user_id . "' AND is_active=1 ORDER BY created_at LIMIT 1";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
}