<?php
class Page extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_page';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
