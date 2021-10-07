<?php
class Transactions extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_transactions';
        $this->primaryKeyField = 'transaction_id';
        parent::__construct();       
    }
}

?>
