<?php

class Pass extends DatabaseObject {

  static protected $table_name = "passes";
  static protected $db_columns = ['id', 'user_id', 'is_active', 'pass_type', 'created_at', 'active_on', 'expires_on', 'pause_on'];
  
  public $id;
  public $user_id;
  public $is_active;
  public $pass_type;
  public $created_at;
  public $active_on;
  public $expires_on;
  public $pause_on;
  
  public const PASS_TYPES = ['A'=>'Administrator','B'=>'Unlimited', 'C'=>'Conditional','D'=>'Base Pass', 'E'=>'Union Pass', 'F'=>'Season Pass'];
  
  public function __construct($args=[]) {
    $this->user_id = $args['user_id'] ?? '';
    $this->is_active = $args['is_active'] ?? '';
    $this->pass_type = $args['pass_type'] ?? '';
    $this->created_at = $args['created_at'] ?? '';
    $this->active_on = $args['active_on'] ?? '';
    $this->expires_on = $args['expires_on'] ?? '';
    $this->pause_on = $args['pause_on'] ?? '';
  }
  
  public function pass_type() {
    $key = $this->pass_type;
    return self::PASS_TYPES[$key];
  }
  
  public function is_active() {
    return ($this->is_active == "1") ? 'Yes' : 'No';
  }
  
  static public function find_expired(){
    $today = date('Y-m-d');
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expires_on > '" . $today . "'";
    return static::find_by_sql($sql);
  }  
  
  static public function find_active(){
    $today = date('Y-m-d');
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expires_on < '" . $today . "'";
    return static::find_by_sql($sql);
  }  
  
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
  
  public function deactive_others() {
    $sql = "UPDATE passes SET is_active=0 WHERE user_id='" . $this->user_id . "' AND id<>'" . $this->id . "';";
    $result = self::$database->query($sql);
    return $result;
  }
  
  // public function pause() {
  //   $this->pause_on = date('Y-m-d');
  //   $this->expires_on = '';
  // }
  
  // public function unpause() {
  //   $today = date('Y-m-d');
  // }
  
  protected function create() {
    // if($this->is_active = '1') {
    //   $this->activate();
    // } elseif($this->is_active = '0') {
    //   $this->active_on = '';
    // }
    return parent::create();
  }
  
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

  // protected function update() {
  //   if($this->is_active = '1' && !isset($this->active_on)) {
  //     $this->activate();
  //   } elseif($this->is_active = '1' && isset($this->active_on)) {
  //     $this->unpause();
  //   } elseif($this->is_active = '0' && isset($this->active_on)) {
  //     $this->pause();
  //   } 
  //   return parent::update();
  // }
  
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->user_id)) {
      $this->error_array[] = ["#first_name" => "User ID cannot be blank."];
    } elseif(!User::find_by_id($this->user_id)) {
      $this->error_array[] = ["#first_name" => "User ID must be for an existing user."];
    }

    return $this->error_array;
  } 
  
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