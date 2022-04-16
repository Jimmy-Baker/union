<?php

class Group extends DatabaseObject {

  static protected $table_name = "groups";
  static protected $db_columns = ['id', 'leader_id', 'type_abv'];
  
  public $id;
  public $leader_id;
  public $type_abv;
  
  public function __construct($args=[]) {
    $this->leader_id = $args['leader_id'] ?? '';
    $this->type_abv = $args['type_abv'] ?? '';
  }
  
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->leader_id)) {
      $this->error_array += ["LeaderID" => "Group type cannot be blank."];
    }
    
    if(is_blank($this->type_abv)) {
      $this->error_array += ["GroupType" => "Group type cannot be blank."];
    }
  }
  
}