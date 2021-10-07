<?php
class Advertiser extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_advertiser';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
