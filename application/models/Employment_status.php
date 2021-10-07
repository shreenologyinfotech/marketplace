<?php
class Employment_status extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_employment_status';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
