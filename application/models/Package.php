<?php
class Package extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_package';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
