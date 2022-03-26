<?php

class Event extends DatabaseObject {

  static protected $table_name = "events";
  static protected $db_columns = ['id', 'start_date', 'end_date', 'location_id', 'event_name', 'participants', 'cost', 'url', 'photo_data'];
  
  public $id;
  public $start_date;
  public $end_date;
  public $location_id;
  public $event_name;
  public $participants;
  public $cost;
  public $url;
  public $photo_data;
  
  public function __construct($args=[]) {
    $this->start_date = $args['start_date'] ?? '';
    $this->end_date = $args['end_date'] ?? '';
    $this->location_id = $args['location_id'] ?? '';
    $this->event_name = $args['event_name'] ?? '';
    $this->participants = $args['participants'] ?? '';
    $this->cost = $args['cost'] ?? '';
    $this->url = $args['url'] ?? '';
    $this->photo_data = $args['photo_data'] ?? '';
  }
  
}
