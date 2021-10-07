<?php
class Withdraw extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_advert_viewer_withdraw';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
