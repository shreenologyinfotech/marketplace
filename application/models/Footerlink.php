<?php
class Footerlink extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_footer_links';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}
?>
