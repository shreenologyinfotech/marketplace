<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$styleArray;

class Export extends Master{
    function __construct(){
        parent::__construct();

        $this->styleArray = array(
			'font' => array(
				'bold' => true,
				),
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				),
			'borders' => array(
				'top' => array(
					'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					),
				),
			'fill' => array(
				'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startcolor' => array('argb' => 'FFA0A0A0'),'endcolor' => array('argb' => 'FFFFFFFF')));
    }

 

    function exportorderstatus(){
		 
    	$data = $this->db->get("tbl_orders")->result();

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'Order Number')
		->setCellValue("B1",'Total Quantity')
		->setCellValue("C1",'Total View')
		->setCellValue("D1",'Total Click Through');
		// Add some data
		

		$x= 2;
		
		foreach($data as $result){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",get_order_id($result->id))
			->setCellValue("B$x",$result->quantity)
			->setCellValue("C$x",$this->Common->getTotalViewOrderById(array("order_id"=>$result->id)))
			->setCellValue("D$x",$this->Common->getTotalViewOrderById(array("order_id"=>$result->id,"is_clicked"=>"yes")));
			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="orderstatus.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');


    }



    function exportUsers(){
    	$this->db->select("*");
    	$this->db->where(array("tbl_advert_viewer.status <> "=>"Deleted"));
    	$this->db->from("tbl_advert_viewer");
        $this->db->join("tbl_advert_viewer_bank","tbl_advert_viewer.id = tbl_advert_viewer_bank.user_id","left");
    	$data = $this->db->get()->result();

    	//$data = $this->db->get("tbl_advert_viewer")->result();

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'User Id')
		->setCellValue("B1",'Mobile')
		->setCellValue("C1",'Email')
		->setCellValue("D1",'Postal Code')
		->setCellValue("E1",'Unit Number')
		->setCellValue("F1",'Referral Code')
		->setCellValue("G1",'Date Joined')
		->setCellValue("H1",'Payment Mode(Bank Account or Paynow)')
		->setCellValue("I1",'Account Holder Name')
		->setCellValue("J1",'Account Number')
		->setCellValue("K1",'Bank Name')
		->setCellValue("L1",'Registered Mobile Number')

		;
		// Add some data
		$appUserPrefix = get_meta_value("appuser_prefix");

		$x= 2;
		
		foreach($data as $result){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",$appUserPrefix.$result->user_id)
			->setCellValue("B$x",$result->contact_number)
			->setCellValue("C$x",$result->email)
			->setCellValue("D$x",$result->postal_code)
			->setCellValue("E$x",$result->unit_number)
			->setCellValue("F$x",$result->self_referral_code)
			->setCellValue("G$x",date(date_out(),strtotime($result->created)))
			->setCellValue("H$x",$result->payment_mode)
			->setCellValue("I$x",$result->account_holder_name)
			->setCellValue("J$x",$result->account_number)
			->setCellValue("K$x",$result->bank_name)
			->setCellValue("L$x",$result->payment_mobile_number);
			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="appusers.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');


    }


    function exporttransaction(){
		$adveritserPrefixValue = get_meta_value("advertiser_prefix");
	


		$data = $this->db->get("tbl_transactions")->result();
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'Order Number')
		->setCellValue("B1",'Transaction Date')
		->setCellValue("C1",'Transaction Type')
		->setCellValue("D1",'Payment Amount')
		->setCellValue("E1",'Refund Amount')
		->setCellValue("F1",'Advertiser ID');
		// Add some data
		$x= 2;
		foreach($data as $result){
			$userId = $result->user_id;
			if($userId == ""){
				$userId = "Admin";
			}else{
				$userId = $adveritserPrefixValue.$userId;				
			}



			$amount = 0;
			if($result->transaction_type == "refund"){
					$result->amount = 0;
					$amount = get_refund_amount_from_order_id($result->order_id);
			}else{
				$amount = 0;	
			}


			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",get_order_id($result->order_id))
			->setCellValue("B$x",date(date_out(),strtotime($result->date)))
			->setCellValue("C$x",$result->transaction_type)
			->setCellValue("D$x",$result->amount)
			->setCellValue("E$x",$amount)
			->setCellValue("F$x",$userId);
			$x++;
		}
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="transaction.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');

    }



    function exportAdvertiser(){
    	$adveritserPrefixValue = get_meta_value("advertiser_prefix");
    	$this->db->where(["status <> "=>"Deleted"]);
    	$data = $this->db->get("tbl_advertiser")->result();

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'Advertiser Id')
		->setCellValue("B1",'First Name')
		->setCellValue("C1",'Last Name')
		->setCellValue("D1",'Email')
		->setCellValue("E1",'Contact')
		->setCellValue("F1",'Company')
		->setCellValue("G1",'Signup Date')
		->setCellValue("H1",'Partner?');
		// Add some data
		$x= 2;
		foreach($data as $result){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",$adveritserPrefixValue.$result->id)
			->setCellValue("B$x",$result->fname)
			->setCellValue("C$x",$result->lname)
			->setCellValue("D$x",$result->email)
			->setCellValue("E$x",$result->contact_number)
			->setCellValue("F$x",$result->company_name)
			->setCellValue("G$x",date(date_out(),strtotime($result->created)))
			->setCellValue("H$x",$result->is_partner);
			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="advertiser.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
    }




     function exportOrders(){

	
     	$this->db->select("*,tbl_invoice.id as invoice_id,tbl_orders.id as order_pid,tbl_orders.order_id as order_number,tbl_orders.status as order_status,tbl_orders.quantity as order_quantity");
        $this->db->from("tbl_orders");
        $this->db->join("tbl_invoice","tbl_invoice.order_id = tbl_orders.id","left");
    	$data = $this->db->get()->result();

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'Order number')
		->setCellValue("B1",'Order status')
		->setCellValue("C1",'Order date')
		->setCellValue("D1",'Start date')
		->setCellValue("E1",'End date')
		->setCellValue("F1",'Area')
		->setCellValue("G1",'Postal code')
		->setCellValue("H1",'Quantity')
		->setCellValue("I1",'Total Cost')
		->setCellValue("J1",'Remain Credit')
		->setCellValue("K1",'Invoice Number')
		->setCellValue("L1",'Image File');
		// Add some data
		$x= 2;
		foreach($data as $result){
			if($result->invoice_id != ""){
			  $invoice_id =  get_invoice_id($result->order_pid);
			}else{
			  $invoice_id =  "NIL";
			}
				
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",get_order_id($result->order_pid))
			->setCellValue("B$x",$result->order_status)
			->setCellValue("C$x",date(date_out(),strtotime($result->created)))
			->setCellValue("D$x",date(date_out(),strtotime($result->start_date)))
			->setCellValue("E$x",date(date_out(),strtotime($result->end_date)))
			->setCellValue("F$x",$result->order_type)
			->setCellValue("G$x",get_zip_code_by_order_id($result->order_pid))
			->setCellValue("H$x",$result->order_quantity)
			->setCellValue("I$x",$result->total_cost)
			->setCellValue("J$x",$result->remaining_balance)
			->setCellValue("k$x", $invoice_id)
			->setCellValue("L$x",$result->image_path);
			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="orders.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
    }


    function exportcontact(){
    	$this->db->select("*");
    	$this->db->from("tbl_contact_form_data");
    	$data = $this->db->get()->result();


    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)

		->setCellValue("A1",'First Name')
		->setCellValue("B1",'Last Name')
		->setCellValue("C1",'Email')
		->setCellValue("D1",'Message')
		->setCellValue("E1",'Contact')
		->setCellValue("F1",'Date');
		// Add some data
	

		$x= 2;
		$adveritserPrefixValue = get_meta_value("advertiser_prefix");
		foreach($data as $result){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",$result->fname)
			->setCellValue("B$x",$result->lname)
			->setCellValue("C$x",$result->email)
			->setCellValue("D$x",$result->msg)
			->setCellValue("E$x",$result->contact_number)
			->setCellValue("F$x",date(date_out(),strtotime($result->created)));

			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="contactform.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');



    }
    	

    function exportwithdraw(){
    	$appUserPrefix = get_meta_value("appuser_prefix");
    	$this->db->select("*,tbl_advert_viewer_withdraw.id as withdraw_id,tbl_advert_viewer_withdraw.created as withdraw_created,	tbl_advert_viewer_withdraw.status as withdraw_status");
    	$this->db->from("tbl_advert_viewer_withdraw");
    	$this->db->join("tbl_advert_viewer","tbl_advert_viewer.id = tbl_advert_viewer_withdraw.user_id","left");

    	$this->db->join("tbl_advert_viewer_bank","tbl_advert_viewer.id = tbl_advert_viewer_bank.user_id","left");

    	$data = $this->db->get()->result();


    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'User ID')
		->setCellValue("B1",'Withdrawal No')
		->setCellValue("C1",'Withdrawal Request Date')
		->setCellValue("D1",'Withdrawal Status')
		->setCellValue("E1",'Withdrawal Processed date')
		->setCellValue("F1",'Payment Mode')
		->setCellValue("G1",'Amount')
		->setCellValue("H1",'Account Number')
		->setCellValue("I1",'Account Holder Name')
		->setCellValue("J1",'Bank Name')
		->setCellValue("K1",'Payment Mobile Number')
		;

		// Add some data
		
		$x= 2;


		$x= 2;
		$adveritserPrefixValue = get_meta_value("advertiser_prefix");
		foreach($data as $result){

			$withdrawProcessDate = "";
			$withdrawCreatedDate = ""; 

			if($result->withdraw_created != ""){
				$withdrawCreatedDate = date(date_out(),strtotime($result->withdraw_created)); 
			}

			if($result->withdraw_process_date != ""){
				$withdrawProcessDate = date(date_out(),strtotime($result->withdraw_process_date)); 
			}

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",$appUserPrefix.$result->user_id)
			->setCellValue("B$x",get_withdraw_id($result->withdraw_id))
			->setCellValue("C$x",$withdrawCreatedDate)
			->setCellValue("D$x",$result->withdraw_status)
			->setCellValue("E$x",$withdrawProcessDate)
			->setCellValue("F$x",$result->payment_mode)
			->setCellValue("G$x",$result->amount)
			->setCellValue("H$x",$result->account_number)
			->setCellValue("I$x",$result->account_holder_name)
			->setCellValue("J$x",$result->bank_name)
			->setCellValue("K$x",$result->payment_mobile_number);
			
			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="withdrawal.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');



    }




    function refundExport(){
    	$this->db->select("*,tbl_advertiser_orders_refund.id as refund_id,tbl_advertiser_orders_refund.created as refund_request_date,tbl_advertiser_orders_refund.status as refund_status, tbl_orders.id as order_pid,tbl_orders.order_id as order_number,tbl_orders.status as order_status,tbl_orders.quantity as order_quantity");
        $this->db->from("tbl_advertiser_orders_refund");
        $this->db->join("tbl_orders","tbl_advertiser_orders_refund.order_id = tbl_orders.id","left");
        $this->db->join("tbl_advertiser","tbl_advertiser_orders_refund.user_id = tbl_advertiser.id","left");
    	$data = $this->db->get()->result();

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($this->styleArray);
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A1",'Refund number')
		->setCellValue("B1",'Cancel Order Date')
		->setCellValue("C1",'Refund request date')
		->setCellValue("D1",'Refund status')
		->setCellValue("E1",'Refund process date')
		->setCellValue("F1",'Refund amount')
		->setCellValue("G1",'User id')
		->setCellValue("H1",'Order number')
		->setCellValue("I1",'Order status');
		// Add some data
		
		$x= 2;
		$adveritserPrefixValue = get_meta_value("advertiser_prefix");
		foreach($data as $result){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",get_refund_id($result->refund_id))
			->setCellValue("B$x",date(date_out(),strtotime($result->refund_request_date)))
			->setCellValue("C$x",date(date_out(),strtotime($result->refund_request_date)))
			->setCellValue("D$x",$result->refund_status)
			->setCellValue("E$x",date(date_out(),strtotime($result->refund_process_date)))
			->setCellValue("F$x",$result->refunded_amount)
			->setCellValue("G$x",$adveritserPrefixValue.$result->user_id)
			->setCellValue("H$x",get_order_id($result->order_pid))
			->setCellValue("I$x",$result->order_status);

			$x++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="refund.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');



    }





}

?>
