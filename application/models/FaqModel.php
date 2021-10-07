<?php
class FaqModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_faq';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
