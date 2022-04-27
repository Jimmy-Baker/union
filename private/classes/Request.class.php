<?php

class Request extends DatabaseObject {

  static protected $table_name = "password_reset";
  static protected $db_columns = ['id', 'user_id', 'password_hash', 'requested'];
  
  protected $id;
  public $user_id;
  protected $password_hash;
  protected $requested;
  
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
    $create = parent::create();
    $event = $this->timeout();
    if($create && $event) {
      return $create;
    } elseif(!$event) {
      $create->delete();
      return false;
    } else {
      return false;
    }
  }
  
  protected function timeout(){
    $sql = "CREATE EVENT delete_" . parent::$database->escape_string($this->id) . " ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 5 MINUTE DO DELETE FROM password_reset WHERE password_reset.id = '" . parent::$database->escape_string($this->id) . "';";
    $result = self::$database->query($sql);
    return $result;
  }
  
}