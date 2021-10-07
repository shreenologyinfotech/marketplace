<?php
class WithdrawComments extends Master{
    function __construct(){
        parent::__construct();
        $this->table = 'tbl_advert_viewer_withdraw_comments';
        $this->primaryKeyField = 'id';
        parent::__construct();       
    }
}

?>
