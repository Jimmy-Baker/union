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
  
  public const PASS_TYPES = ['AA'=>'Administrator','GM'=>'Gym Manager', 'GS'=>'Gym Staff','MM'=>'Member', ''=>'None'];
  
  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->is_active = $args['is_active'] ?? '';
    $this->pass_type = $args['pass_type'] ?? '';
    $this->created_at = $args['created_at'] ?? '';
    $this->active_on = $args['active_on'] ?? '';
    $this->expires_on = $args['expires_on'] ?? '';
    $this->pause_on = $args['pause_on'] ?? '';
  }
  
  public function pass_type() {
    switch ($this->pass_type) {
      case 'AA': return self::PASS_TYPES[0];
        break;
      case 'GM': return self::PASS_TYPES[1];
        break;
      case 'GS': return self::PASS_TYPES[2];
        break;
      case 'MM': return self::PASS_TYPES[3];
        break;
      case '': return self::PASS_TYPES[4];
        break;
    }
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
    $this->expires_on = date('Y-m-d', strtotime($today . ' + 365 days'));
  }
  
  public function pause() {
    $this->pause_on = date('Y-m-d');
    $this->expires_on = '';
  }
  
  public function unpause() {
    $today = date('Y-m-d');
    
  }
  
  protected function create() {
    if($this->is_active = 1) {
      $this->activate();
    } elseif($this->is_active = 0) {
      $this->active_on = '';
    }
    return parent::create();
  }

  protected function update() {
    if($this->is_active = 1 && !isset($this->active_on)) {
      $this->activate();
    } elseif($this->is_active = 1 && isset($this->active_on)) {
      $this->unpause();
    } elseif($this->is_active = 0 && isset($this->active_on)) {
      $this->pause();
    } 
    return parent::update();
  }
  
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->user_id)) {
      $this->error_array[] = ["#first_name", "User ID cannot be blank."];
    } elseif(!User::find_by_id($this->user_id)) {
      $this->error_array[] = ["#first_name", "User ID must be for an existing user."];
    }

    return $this->error_array;
  } 
  
}