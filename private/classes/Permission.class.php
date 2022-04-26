<?php 

class Permission extends DatabaseObject {

  static protected $table_name = "permissions";
  static protected $db_columns = ['abv', 'description'];
  
  public $abv;
  public $description;
  
  public function __construct($args=[]) {
    $this->abv = $args['abv'] ?? '';
    $this->description = $args['description'] ?? '';
  }
  
  public static function test_location_user_permission($location_id, $user_id, $permission_abv){
  $sql = "SELECT group_permissions.location_id FROM group_permissions JOIN group_users ON group_permissions.group_id = group_users.group_id WHERE group_permissions.location_id='" . parent::$database->escape_string($location_id) . "' AND group_users.user_id='" . parent::$database->escape_string($user_id) . "' AND group_permissions.permission_abv='" . parent::$database->escape_string($permission_abv) . "'";
  $result = self::$database->query($sql);
  if($result->num_rows >0) {
    return true;
  } else {
    return false;
  }
  return $result;
  }
  
  public static function find_locations_by_user_permission($user_id, $permission_abv){
    $sql = "SELECT group_permissions.location_id, locations.location_name, gyms.gym_name FROM (group_permissions JOIN group_users ON group_permissions.group_id = group_users.group_id) JOIN (locations LEFT JOIN gyms ON locations.gym_id = gyms.id) ON group_permissions.location_id=locations.id WHERE group_users.user_id='" . parent::$database->escape_string($user_id) . "' AND group_permissions.permission_abv='" . parent::$database->escape_string($permission_abv) . "';";
    $results = self::$database->query($sql);
    $array = [];
    while($record = $results->fetch_assoc()){
      $object = (object) $record;
      $array[] = $object;
    }
    $results->free();
    return $array;
  }
}