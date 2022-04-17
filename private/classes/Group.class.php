<?php

class Group extends DatabaseObject {

  static protected $table_name = "groups";
  static protected $db_columns = ['id', 'leader_id', 'type_abv', 'name'];
  
  public $id;
  public $leader_id;
  public $type_abv;
  public $name;
  
  public function __construct($args=[]) {
    $this->leader_id = $args['leader_id'] ?? '';
    $this->type_abv = $args['type_abv'] ?? '';
    $this->name = $args['name'] ?? '';
  }
  
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->leader_id)) {
      $this->error_array += ["LeaderID" => "Group leader ID cannot be blank."];
    } elseif (!ctype_digit($this->leader_id)) {
      $this->error_array += ["LeaderID" => "Group leader ID can only contain numerals."];
    } elseif (!has_length($this->leader_id, array('max' => 5))) {
      $this->error_array += ["LeaderID" => "Group leader ID must be 8 digits or less."];
    }
    
    if(is_blank($this->type_abv)) {
      $this->error_array += ["GroupType" => "Group type cannot be blank."];
    }
    
    if(is_blank($this->name)) {
      $this->error_array += ["GroupName" => "Group name cannot be blank."];
    } elseif (!has_length($this->name, array('min' => 1, 'max' => 32))) {
      $this->error_array += ["GroupName" => "Group name must be less than 32 characters."];
    } elseif (has_padding($this->name)) {
      $this->error_array += ["GroupName" => "Group name cannot start or end with a space."];
    } elseif (!has_valid_char($this->name)) {
      $this->error_array += ["GroupName" => "Group name must consist of letters, numbers, dashes, and spaces."];
    }

  }
  
}