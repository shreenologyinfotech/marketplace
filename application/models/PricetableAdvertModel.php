<?php
class PricetableAdvertModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_price_table_advert_viewer';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
