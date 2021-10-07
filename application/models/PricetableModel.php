<?php
class PricetableModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_pricetable';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
