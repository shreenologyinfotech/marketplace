<?php
class Contact extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_contact_form_data';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
