<?php
class Newsletter extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_newsletter';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
