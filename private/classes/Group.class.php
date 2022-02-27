<?php

class Group extends DatabaseObject {

  static protected $table_name = "groups";
  static protected $db_columns = ['id', 'leader_id', 'type_abv'];
  
  public $id;
  public $leader_id;
  public $type_abv;
  
  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->leader_id = $args['leader_id'] ?? '';
    $this->type_abv = $args['type_abv'] ?? '';
  }
  
}