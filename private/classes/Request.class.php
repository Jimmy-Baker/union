<?php

class Request extends DatabaseObject {

  static protected $table_name = "password_reset";
  static protected $db_columns = ['id', 'user_id', 'password_hash', 'requested'];
  
  protected $id;
  public $user_id;
  protected $password_hash;
  protected $requested;
  
  public $password;
  
  /** 
   * Constructs a Request object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated request
   */
  public function __construct($args=[]) {
    $this->user_id = $args['user_id'] ?? '';
    $this->requested = '';
    $this->password = $args['key'] ?? '';
  }
  
  /** 
   * Updates a User's password_hash with the BCRYPT of its password
   *  
   */
  protected function set_password_hash() {
    $this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);
  }
  
  /** 
   * Tests a string against the Request's password_hash  
   * 
   * @param string $password A string to test 
   * @return boolean ex. True or False  
   */
  public function verify_password($key) {
    return password_verify($key, $this->password_hash);
  }
  
  /** 
   * Sets the Request's password_hash before creating a database record  
   * 
   * @return boolean ex. True if record was created sucessfully
   */
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
  
  /** 
   * Deletes all Request records for a given user_id
   *  
   * @param string $id The user_id to process 
   * @return boolean ex. False if the delete failed 
   */
  public static function delete_all($id) {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($id) . "' ";
    $result = self::$database->query($sql);
    return $result;
  }
  
  /** 
   * Creats a MySQL event to delete a request record after 5 minute 
   * 
   * @return boolean ex. True if event creation was succesful 
   */
  protected function timeout(){
    $sql = "CREATE EVENT delete_" . parent::$database->escape_string($this->id) . " ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 5 MINUTE DO DELETE FROM password_reset WHERE password_reset.id = '" . parent::$database->escape_string($this->id) . "';";
    $result = self::$database->query($sql);
    return $result;
  }
  
}