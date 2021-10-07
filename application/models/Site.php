<?php
class Site extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_setting';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
