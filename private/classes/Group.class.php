<?php

class Group extends DatabaseObject {

  static protected $table_name = "groups";
  static protected $db_columns = ['id', 'owner_id', 'type_abv', 'name'];
  
  public $id;
  public $owner_id;
  public $type_abv;
  public $name;
  
  /** 
   * Constructs a Group object with properties set with an associative array   
   *
   * @param array $args Values to set the properties with   
   * @return object An instantiated group
   */
  public function __construct($args=[]) {
    $this->owner_id = $args['owner_id'] ?? '';
    $this->type_abv = $args['type_abv'] ?? '';
    $this->name = $args['name'] ?? '';
  }
  
  /** 
   * Tests Group properties for valid HTML input values
   *
   * @return array HTML elements as keys and messages as values 
   */
  protected function validate() {
    $this->error_array = [];

    if(is_blank($this->owner_id)) {
      $this->error_array += ["OwnerID" => "Group leader ID cannot be blank."];
    } elseif (!ctype_digit($this->owner_id)) {
      $this->error_array += ["OwnerID" => "Group leader ID can only contain numerals."];
    } elseif (!has_length($this->owner_id, array('max' => 5))) {
      $this->error_array += ["OwnerID" => "Group leader ID must be 8 digits or less."];
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

    return $this->error_array;
  }
  
  /** 
   * Retrieves an array of members in the group as objects
   *   
   * @return array An array of Member objects
   */
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
    $results->free();
    return $array; 
  }
  
  /** 
   * Retrieves all groups a given user is a member of
   *  
   * @param string $user_id The user to find group associations with 
   * @return array An array of Group objects
   */
  static public function find_all_by_member($user_id) {
    $sql = "SELECT groups.* FROM groups LEFT JOIN group_users ON groups.id = group_users.group_id WHERE group_users.user_id='" . parent::$database->escape_string($user_id) . "';";
    return parent::find_by_sql($sql);
  }
  
  /** 
   * Adds a user to the group with a defined role
   * 
   * @param string $user_id The id of the user to add to the group
   * @param string $role The role to attribute to the user
   * @return boolean ex. True if successful 
   */
  public function add_user($user_id, $role){
    $sql = "INSERT INTO group_users (group_id, user_id, role_abv) VALUES ('" . parent::$database->escape_string($this->id) . "', '" . parent::$database->escape_string($user_id) . "', '" . parent::$database->escape_string($role) ."');";
    $result = parent::$database->query($sql);
    return $result;
  }
  
  /** 
   * Removes a member from the group 
   * 
   * @param string $user_id the if of the user to remove from the group
   * @return boolean ex. True if successful 
   */
  public function remove_user($user_id) {
    $sql = "DELETE FROM group_users WHERE user_id='" . parent::$database->escape_string($user_id) . "' AND group_id='" . parent::$database->escape_string($this->id) . "' LIMIT 1;";
    $result = parent::$database->query($sql);
    return $result;
  }
  
  /** 
   * Tests if a user has a specific role within a group
   *  
   * @param string $group_id The group to look within
   * @param string $user_id The user to evaluate
   * @param string $role The role to specify 
   * @return boolean ex. True if the user has the role within the group
   */
  public static function test_group_user_role($group_id, $user_id, $role) {
    $sql = "SELECT user_id FROM group_users WHERE group_id='" . parent::$database->escape_string($group_id) . "' AND user_id='" . parent::$database->escape_string($user_id) . "' AND role='" . parent::$database->escape_string($role) . "';";
    $result = self::$database->query($sql);
    if($result->num_rows >0) {
      return true;
    } else {
      return false;
    }
  }
  
  /** 
   * Tests if a user exists within a group 
   * 
   * @param string $group_id The group to look within
   * @param string $user_id The user to evaluate
   * @return boolean ex. True if the user has the role within the group
   */
  public static function test_group_user($group_id, $user_id) {
    $sql = "SELECT user_id FROM group_users WHERE group_id='" . parent::$database->escape_string($group_id) . "' AND user_id='" . parent::$database->escape_string($user_id) . "';";
    $result = self::$database->query($sql);
    if($result->num_rows >0) {
      return true;
    } else {
      return false;
    }
  }
}