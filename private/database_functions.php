<?php

/** 
 * Creates a mysqli connection using stored parameters 
 * 
 * @return object A mysqli object 
 */
function db_connect() {
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  $connection->set_charset('utf8mb4');
  confirm_db_connect($connection);
  return $connection;
}

/** 
 * Tests a mysqli object for connection errors  
 * 
 * @param object $connection A mysqli object
 * @return $msg A connection failure message 
 */
function confirm_db_connect($connection) {
  if($connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $connection->connect_error;
    $msg .= " (" . $connection->connect_errno . ")";
    exit($msg);
  }
}

/** 
 * Ends an active connection to a database 
 * 
 * @param object $connection A mysqli object
 */
function db_disconnect($connection) {
  if(isset($connection)) {
    $connection->close();
  }
}

?>