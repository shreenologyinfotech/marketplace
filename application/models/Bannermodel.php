<?php
class Bannermodel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_banner';
        $this->primaryKeyField = 'banner_id';
        parent::__construct();       
    }
}

?>
