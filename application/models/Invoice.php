<?php
class Invoice extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_invoice';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
