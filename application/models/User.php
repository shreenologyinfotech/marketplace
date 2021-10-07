<?php
class User extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_advert_viewer';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
