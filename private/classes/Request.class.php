<?php

class Request extends DatabaseObject {

  static protected $table_name = "password_reset";
  static protected $db_columns = ['id', 'user_id', 'password_hash', 'requested'];
  
  public $id;
  public $user_id;
  protected $password_hash;
  public $requested;
  
  public $password;
  
  public function __construct($args=[]) {
    $this->user_id = $args['user_id'] ?? '';
    $this->requested = '';
    $this->password = $args['key'] ?? '';
  }
  
  protected function set_password_hash() {
    $this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);
  }
  
  public function verify_password($key) {
    return password_verify($key, $this->password_hash);
  }
  
  protected function create() {
    $this->set_password_hash();
    return parent::create();
  }
}
