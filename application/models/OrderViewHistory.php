<?php
class OrderViewHistory extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_order_view_history';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
