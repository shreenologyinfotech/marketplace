<?php
class BrandModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_brands';
        $this->primaryKeyField = 'brand_id';
        parent::__construct();       
    }
}

?>
