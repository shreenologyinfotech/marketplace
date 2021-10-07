<?php
class Promo extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_promo';
        $this->primaryKeyField = 'promo_id';
        parent::__construct();       
    }
}

?>
