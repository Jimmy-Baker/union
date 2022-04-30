<?php

class Search {
  
  static protected $database;
  public $table;
  public $parameter1;
  public $parameter2;
  public $parameter3;
  public $parameter4;
  public $value1;
  public $value2;
  public $value3;
  public $value4;
  public $error_array = [];
  
  public function __construct($args=[]) {
    $this->parameter1 = $args['inputParameter1'] ?? '';
    $this->parameter2 = $args['inputParameter2'] ?? '';
    $this->parameter3 = $args['inputParameter3'] ?? '';
    $this->parameter4 = $args['inputParameter4'] ?? '';
    $this->value1 = $args['inputValue1'] ?? '';
    $this->value2 = $args['inputValue2'] ?? '';
    $this->value3 = $args['inputValue3'] ?? '';
    $this->value4 = $args['inputValue4'] ?? '';
  }
  
  static public function set_database($database) {
    self::$database = $database;
  }
  
  public function getSQL() {
    $this->validate();
    if(empty($this->error_array)){
      if ($this->value1 != '' && $this->parameter1 != ''){
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        $sql .= self::$database->escape_string($this->parameter1) . " LIKE '%" . self::$database->escape_string($this->value1) . "%'";
      } else {
        return false;
      }
      if ($this->value2 != '' && $this->parameter2 != ''){
      $sql .= " AND " . self::$database->escape_string($this->parameter2) . " LIKE '%" . self::$database->escape_string($this->value2) . "%'";
      }
      if ($this->value3 != '' && $this->parameter3 != ''){
        $sql .= " AND " . self::$database->escape_string($this->parameter3) . " LIKE '%" . self::$database->escape_string($this->value3) . "%'"; 
      }
      if ($this->value3 != '' && $this->parameter3 != ''){
        $sql .= " AND " . self::$database->escape_string($this->parameter3) . " LIKE '%" . self::$database->escape_string($this->value3) . "%'";
      }
      $sql .= ";";
      return $sql;
    } else {
      return false;
    }
  }
  
  
  private function validate(){
    if(!isset($this->parameter1)){
      $this->error_array += ["Parameter1" => "The first parameter cannot be blank."];
    } else {
      if(!has_length($this->value1, array('min' => 1, 'max' => 32))){
        $this->error_array += ["Value1" => "This input must be between 1 and 32 characters."];
      } elseif(has_padding($this->value1)) {
        $this->error_array += ["Value1" => "This input cannot start or end with a space."];         
      } elseif(!has_valid_char($this->value1)) {
        $this->error_array += ["Value1" => "This input must consist of letters, numbers, dashes, and spaces."];
      }
    }
    
    if(isset($this->value2)){
      if($this->parameter2 = ''){
        $this->error_array += ["Parameter2" => "This parameter cannot be blank if selected."];
      } elseif(!has_length($this->value2, array('min' => 1, 'max' => 32))){
        $this->error_array += ["Value2" => "This input must be between 1 and 32 characters."];
      } elseif(has_padding($this->value2)) {
        $this->error_array += ["Value2" => "This input cannot start or end with a space."];         
      } elseif(!has_valid_char($this->value2)) {
        $this->error_array += ["Value2" => "This input must consist of letters, numbers, dashes, and spaces."];
      }
    }
    
    if(isset($this->value3)){
      if($this->parameter3 = ''){
        $this->error_array += ["Parameter3" => "This parameter cannot be blank if selected."];
      } elseif(!has_length($this->value3, array('min' => 1, 'max' => 32))){
        $this->error_array += ["Value3" => "This input must be between 1 and 32 characters."];
      } elseif(has_padding($this->value3)) {
        $this->error_array += ["Value3" => "This input cannot start or end with a space."];         
      } elseif(!has_valid_char($this->value3)) {
        $this->error_array += ["Value3" => "This input must consist of letters, numbers, dashes, and spaces."];
      }
    }
    
    if(isset($this->value4)){
      if($this->parameter4 = ''){
        $this->error_array += ["Parameter4" => "This parameter cannot be blank if selected."];
      } elseif(!has_length($this->value4, array('min' => 1, 'max' => 32))){
        $this->error_array += ["Value4" => "This input must be between 1 and 32 characters."];
      } elseif(has_padding($this->value4)) {
        $this->error_array += ["Value4" => "This input cannot start or end with a space."];         
      } elseif(!has_valid_char($this->value4)) {
        $this->error_array += ["Value4" => "This input must consist of letters, numbers, dashes, and spaces."];
      }
    }
    
  }
}

?>