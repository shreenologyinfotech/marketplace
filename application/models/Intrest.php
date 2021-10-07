<?php
class Intrest extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_interests';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
