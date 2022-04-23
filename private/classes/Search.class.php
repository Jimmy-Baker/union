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
    if($this->validate()){
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
    return true;
  }
}

?>