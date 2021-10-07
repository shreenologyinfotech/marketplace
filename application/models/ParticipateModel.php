<?php
class ParticipateModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_event_participaters';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
