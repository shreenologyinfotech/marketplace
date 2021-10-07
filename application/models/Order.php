<?php
class Order extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_order';
        $this->primaryKeyField = 'order_id';
        parent::__construct();       
    }
}

?>
