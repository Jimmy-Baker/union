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
  
  public function group_members() {
    $sql = "SELECT group_users.user_id, users.first_name, users.last_name, group_users.role_abv FROM group_users INNER JOIN users ON group_users.user_id=users.id WHERE group_users.group_id='" . $this->id . "';";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
      // foreach($object as $prop=>$value){
      //   $value = $value;
      // }
      $array[] = $object;
    }
    return $array; 
  }
  
}