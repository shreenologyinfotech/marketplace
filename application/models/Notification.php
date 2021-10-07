<?php
class Notification extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_notification';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
