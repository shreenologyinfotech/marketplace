<?php
class HomeCategoryModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_home_category';
        $this->primaryKeyField = 'category_id';
        parent::__construct();       
    }
}

?>
