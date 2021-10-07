<?php
class Refund extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_advertiser_orders_refund';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
