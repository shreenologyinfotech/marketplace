<?php
class AboutusModel extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_app_about_us';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
