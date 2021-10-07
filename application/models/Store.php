<?php
class Store extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_stores';
        $this->primaryKeyField = 'store_id';
        parent::__construct();       
    }
}

?>
