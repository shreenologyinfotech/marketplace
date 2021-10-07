<?php
class PageRetails extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_page_retail';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}
?>
