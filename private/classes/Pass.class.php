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
  
  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->is_active = $args['is_active'] ?? '';
    $this->pass_type = $args['created_at'] ?? '';
    $this->created_at = $args['active_on'] ?? '';
    $this->expires_on = $args['expires_on'] ?? '';
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
  
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->user_id)) {
      $this->error_array[] = ["#first_name", "User ID cannot be blank."];
    } elseif(!User::find_by_id($this->user_id)) {
      $this->error_array[] = ["#first_name", "User ID must be for an existing user."];
    }

    if(!isset($this->access_abv)) {
      $this->error_array[] = ["#access_abv", "User access must be selected"];
    }

    return $this->error_array;
  } 
  
}