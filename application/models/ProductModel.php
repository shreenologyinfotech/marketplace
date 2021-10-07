<?php
class ProductModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_products';
        $this->primaryKeyField = 'product_id';
        parent::__construct();       
    }
}

?>
