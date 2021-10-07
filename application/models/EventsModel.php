<?php
class EventsModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_events';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
