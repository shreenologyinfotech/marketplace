<?php
class Subcategorymodel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_product_sub_category';
        $this->primaryKeyField = 'sub_category_id';
        parent::__construct();       
    }
}

?>
