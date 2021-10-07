<?php
class Location extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_advert_location';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
