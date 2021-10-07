<?php
class EmailTemplate extends CI_Model{
    function __construct(){
        parent::__construct();
    }

 


    function sendPaymentSuccesMail($userName,$userEmail){
           /* $data   =  $this->load->view("email-template/general-temmpale",'', true);*/
            $data   =  $this->load->view("email-template/general-template",'', true);
            $data  = str_replace("{{title}}", ORDER_COMPLETED_SUBJECT, $data);
            $data  = str_replace("{{to.name}}", $userName, $data);
            $data  = str_replace("{{to.title}}", ORDER_COMPLETED_EMAIL_HEADING, $data);
            $data  = str_replace("{{to.message}}", ORDER_COMPLETED_EMAIL_MESSAGE, $data);
          
            if($this->sendmail($userEmail,$userName,ORDER_COMPLETED_SUBJECT,$data)){
                return true;
            }else{
                return false;    
            }
    }



    function sendVerificationEmailAppUser($userId,$userEmail,$userName){
            $encodeId = base64_encode($userId+APP_ID_SALT);
            $verifyUrl = base_url().'verifyappuser/'.$encodeId;
            $data   =  $this->load->view("email-template/email-verification-appuser",'', true);
            $data  = str_replace("{{to.name}}", $userName, $data);
            $data  = str_replace("{{verify.link}}", $verifyUrl, $data);
            
            if($this->sendmail($userEmail,$userName,VERIFICATION_EMAIL_SUBJECT_APP_USER,$data)){
                return true;
            }else{
                return false;    
            }
    }


    
    function sendVerificationEmailAdvertiser($userId,$userEmail,$userName){
            $encodeId = base64_encode($userId+APP_ID_SALT);
            $verifyUrl = base_url().'verifyadvertiser/'.$encodeId;
            $data   =  $this->load->view("email-template/email-verification",'', true);
            $data  = str_replace("{{to.name}}", $userName, $data);
            $data  = str_replace("{{verify.link}}", $verifyUrl, $data);
            
            if($this->sendmail($userEmail,$userName,VERIFICATION_EMAIL_SUBJECT_ADVERTISER,$data)){
                return true;
            }else{
                return false;    
            }
    }



    function sendForgotPasswordEmail($name,$email,$password){
            $data   =  $this->load->view("email-template/forgot-password",'', true);
            $data  = str_replace("{{to.name}}", $name, $data);
            $data  = str_replace("{{forgot.email}}", $email, $data);
            $data  = str_replace("{{forgot.password}}", $password, $data);

            if($this->sendmail($email,$name,FORGOT_PASSSWORD,$data)){
                return true;
            }else{
                return false;    
            }
    }

    function orderCancelledByAdmin($orderId,$orderUserName,$status,$userEmail){
            $data   =  $this->load->view("email-template/order-status-cancelled-admin",'', true);
            $data  = str_replace("{{order.id}}", $orderId, $data);
            $data  = str_replace("{{order.order_id}}", get_order_id($orderId), $data);
            $data  = str_replace("{{order.user}}", $orderUserName, $data);
            $data  = str_replace("{{order.status}}", strtolower($status), $data);
            if($this->sendmail($userEmail,$orderUserName,ORDER_STATUS_UPDATED,$data)){
                return true;
            }else{
                return false;    
            }
    }


     function sendOrderStatusChangeMail($orderId,$orderUserName,$status,$userEmail){
            $data   =  $this->load->view("email-template/order-status-update",'', true);
            $data  = str_replace("{{order.id}}", $orderId, $data);
            $data  = str_replace("{{order.order_id}}", get_order_id($orderId), $data);
            $data  = str_replace("{{order.user}}", $orderUserName, $data);
            $data  = str_replace("{{order.status}}", strtolower($status), $data);
            if($this->sendmail($userEmail,$orderUserName,ORDER_STATUS_UPDATED,$data)){
                return true;
            }else{
                return false;    
            }
    }



     function sendRefundCompleteMail($orderId,$orderUserName,$userEmail){
            $data   =  $this->load->view("email-template/refund-complete-template",'', true);

            $data  = str_replace("{{order.id}}", $orderId, $data);
            $data  = str_replace("{{order.order_id}}", get_order_id($orderId), $data);
            $data  = str_replace("{{order.user}}", $orderUserName, $data);
            
            if($this->sendmail($userEmail,$orderUserName,REFUND_COMPLETE_EMAIL_SUBJECT,$data)){
                return true;
            }else{
                return false;    
            }
    }


     function sendWithdrawStatusApporveMail($orderUserName,$userEmail){
            $data   =  $this->load->view("email-template/withdraw-request-paid",'', true);

            $data  = str_replace("{{title}}", WITHDRAW_REQUEST_APPROVED, $data);
            $data  = str_replace("{{to.name}}", $orderUserName, $data);
            $data  = str_replace("{{to.message}}", WITHDRAW_REQUEST_APPROVED_MAIL_MSG, $data);

            if($this->sendmail($userEmail,$orderUserName,WITHDRAW_REQUEST_APPROVED,$data)){
                return true;
            }else{
                return false;    
            }
    }


    function sendWithdrawStatusCancelMail($orderUserName,$userEmail){
            $data   =  $this->load->view("email-template/withdraw-request-cancell",'', true);
            
            $data  = str_replace("{{title}}", WITHDRAW_REQUEST_CANCEL, $data);
            $data  = str_replace("{{to.name}}", $orderUserName, $data);
            $data  = str_replace("{{to.message}}", WITHDRAW_REQUEST_CANCEL_MAIL_MSG, $data);

            if($this->sendmail($userEmail,$orderUserName,WITHDRAW_REQUEST_CANCEL,$data)){
                return true;
            }else{
                return false;    
            }    
    }




    function sendWithdrawStatusPaidMail($orderUserName,$userEmail){
            $data   =  $this->load->view("email-template/withdraw-request-paid",'', true);
            
            $data  = str_replace("{{title}}", WITHDRAW_REQUEST_PAID, $data);
            $data  = str_replace("{{to.name}}", $orderUserName, $data);
            $data  = str_replace("{{to.message}}", WITHDRAW_REQUEST_PAID_MAIL_MSG, $data);

            if($this->sendmail($userEmail,$orderUserName,WITHDRAW_REQUEST_PAID,$data)){
                return true;
            }else{
                return false;    
            }    
    }



     function contactusreplymail($email,$message,$userName){
            $data   =  $this->load->view("email-template/reply-contact-us",'', true);

            $data  = str_replace("{{contact.name}}", $userName, $data);
            $data  = str_replace("{{contact.message}}", $message, $data);
           
            
            if($this->sendmail($email,$userName,CONTACT_US_EMAIL,$data)){
                return true;
            }else{
                return false;    
            }
    }




    public function sendmail($email,$toname,$subject,$htmlMessage){

            $to = $email;
            $to_name = $toname;
            $from = get_meta_value("from_email");
            $from_name =  get_meta_value("from_name");
            $subject = $subject;
            $message = $htmlMessage;
            $this->email->clear();
            $this->email->from($from, $from_name);
            $this->email->to($to,$to_name);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->set_mailtype('html');
            $this->email->send();
            return true;
            /*
                $this->load->library('email');
                //SMTP & mail configuration
                $config = array(
                            'protocol' => 'smtp', 
                            'smtp_host' => 'ssl://smtp.gmail.com', 
                            'smtp_port' => 587, 
                            'smtp_user' => 'govindarchive@gmail.com', 
                            'smtp_pass' => 'shyhmzyuizaucovw', 
                            'mailtype' => 'html', 
                            'charset' => 'iso-8859-1',
                            'newline' => "\r\n",
                            'crlf' => "\r\n",
                );
                $this->email->initialize($config);
                $to         = $email;
                $subject    = $subject;
                $message    = $htmlMessage;
                $this->email->from(get_meta_value("from_email"), get_meta_value("from_name"));
                $this->email->reply_to(get_meta_value("from_email"), get_meta_value("from_name"));
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
                    return true;
                }else{
                   echo $this->email->print_debugger();
                   return false;
                }
            */
     }


     


}

?>
