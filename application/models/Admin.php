<?php
class Admin extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_admin';
        $this->primaryKeyField = 'admin_id';
        parent::__construct();       
    }
}

?>
