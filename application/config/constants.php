<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*password*/
define('ENCY_PASSWORD','o_&&*(}*RKJi?XSvap=');

define('SITE_TITLE','Marketplace Phones');
define('GLOBAL_MSG','msg');
define('GLOBAL_MSG_FRONT','msg_front');
define('GLOBAL_MSG_SUCCESS','msg_success');
define('CASHVERTISE_ADMIN_ID','cashvertise_admin_id');
define('FRONT_USER_ID','front_stror_admin_id');
define('CASHVERTISE_ADVERTISER_ID','cashvertise_advertiser_id');
define('APP_ID_SALT',22334455);
/*
define('VERIFICATION_EMAIL_SUBJECT_ADVERTISER','verify-your-email');
define('VERIFICATION_EMAIL_SUBJECT_APP_USER','verify-your-email');
define('FORGOT_PASSSWORD','password-recovery-email');
define('ORDER_STATUS_UPDATED','order-status-updated');
define('WITHDRAW_REQUEST_PAID','withdraw-status-paid');
define('CONTACT_US_EMAIL','in-reply-of-queries');
*/

define('APP_NAME','bikeexchange');
define('IMAGE_PATH_URL','/assets/images/');
define('IMAGE_PATH_ABSULATE','./assets/images/');
define('BANNER_FOLDER','banners/');
define('HOME_CATEGORY_FOLDER','category/');
define('PRODUCT_FOLDER','product/');
define('STORES_FOLDER','stores/');

define('CURRENCY','€');


define('VERIFICATION_EMAIL_SUBJECT_ADVERTISER','Verify Your Email');
define('VERIFICATION_EMAIL_SUBJECT_APP_USER','Verify Your Email');
define('FORGOT_PASSSWORD','Password Recovery');
define('ORDER_STATUS_UPDATED','Order Status Updated');
define('WITHDRAW_REQUEST_PAID','Payment has been made successfully');
define('WITHDRAW_REQUEST_APPROVED','We have approved your withdraw request');
define('CONTACT_US_EMAIL','We have received your enquiry');

/*api constant*/
define('GLOBAL_RESULT_YES','YES');
define('GLOBAL_RESULT_NO','NO'); 
define('GLOBAL_VALIDATION_ERROR','validation error');
define('END_LIMIT',15);
define('REFER_CODE_LENGTH',4);

define('WITHDRAW_STATUS_UDPATE_NOTIFICATION_TITLE','Withdraw Request Status Updated.');
define('WITHDRAW_STATUS_UDPATE_NOTIFICATION_MSG','Withdraw request has been ');

define('ADVERTISER_EMAIL_ALREADY_REGISTERED','This email address is already registered.'); 
define('ADVERTISER_PHONE_ALREADY_REGISTERED','This phone number is already register with us.');
define('SOMETHING_WENT_WRONG_PLEASE_TRY_LATER','Something went wrong please try again later.');
define('LOGIN_VERIFICATION_EMAIL_SEND','A verification email has been sent. Click on the verification link in the email to activate your account.');
define('ADVERTISER_SIGN_UP_SUCCESS','A verification email has been sent. Click on the verification link in the email to activate your account.'); 
define('ACCOUNT_NOT_APPROVED_PLEASE_WAIT','Your account has not been approved yet please wait.');
define('ACCOUNT_BLOCK_BY_ADMIN','Your account has been block by admin please contact to site administrator.');
define('LOGIN_SUCCESS','Login Successful.');
define('NOT_VALID_CREDENTIALS','Incorrect email/password.');
define('EMAIL_VERIFICATION_TITLE_HEADING','Thank you for joining us in changing the way advertising is done. Complete your account creation by clicking on the link below');
define('EMAIL_VERIFICATION_TITLE_HEADING_APP_USER','You are one step away from withdrawing your cash. Click on the link below to verify your email.');
define('EMAIL_VERIFICATION_SUCCESS_TITLE','You are verified!');
define('EMAIL_VERIFICATION_SUCCESS_SUB_TITLE','Thank you. Your email verification is successful.');

define('PASSWORD_CHANGE_SUCCESS','Password has been changed successfully.');
define('INVALID_OLD_PASSWORD','Invalid old password.'); /*Passwords do not match*/
define('EMAIL_NOT_REGISTER_WITH_US','This email not register with us.');
define('LOGIN_CREDENTIALS_SENT_TO_EMAIL','Your password has been sent to your email.');
define('PAYMENT_UNSUCCESSFUL_TITLE','Payment Unsuccessful');
define('OOPS','OOPS!'); 
define('PAYMENT_HAS_BEEN_CANCEL','Your payment has been cancelled. Please try making the payment again.');
define('BACK_TO_HOME','Back to Home');
define('APP_FAQ_UPDATED_SUCCESS_MESSAGE','FAQ updated successfully');
define('APP_FAQ_ADD_SUCCESS_MESSAGE','FAQ added successfully');
define('AUTO_REPLY_EMAIL_MESSAGE','Thank you so	much for reaching out to us! We will get back to you as soon as possible.');

define('WARNING_IMAGE_RESOLUTION_CREATE_ORDER',"Image resolution must be greater than 760 x 760");
define('ARE_YOU_SURE',"Are you sure?");
define('ORDER_DELETE_ADVERTISER_CONFIRM_MSG',"Once order is deleted, you would not be able to undo this");
define('ORDER_DELETE_ADVERTISER_SUCCESS_MSG',"Order deleted successfully");
define('ORDER_DELETE_ADVERTISER_SUCCESS_HEADING',"Deleted!");


define('ORDER_REFUND_ADVERTISER_CONFIRM_MSG',"Are you looking to refund your credits?");
define('ORDER_REFUND_ADVERTISER_SUCCESS_MSG',"Refund request has been submitted.");

define('ORDER_DELETE_ADMIN_HEADING',"Delete Order");
define('ORDER_DELETE_ADMIN_CONFIRM_MSG',"Are you sure you want to delete this order?");
define('ORDER_DELETE_ADMIN_SUCCESS_MSG',"Order deleted successfully");
define('PAYMENT_SUCCESS_TITLE',"PAYMENT SUCCESSFUL");
define('THANK_YOU',"THANK YOU!");

define('ORDER_COMPLETED_SUBJECT','Your Payment is Successful');
define('ORDER_COMPLETED_EMAIL_HEADING','Thank you for using our service at CashVertise. Your payment is successful.');
define('ORDER_COMPLETED_EMAIL_MESSAGE','At CashVertise, we do our best to ensure that our advertisements are not inappropriate for children. Hence, we will review your advertising image(s) and update you within the next 2 working days.');



define('ACTION_COMPLETE_REFUND_TITLE','Refund');
define('ACTION_COMPLETE_REFUND_HEADING','Please confirm if refund has been processed?');
define('ACTION_COMPLETE_REFUND_SUCCESS_MSG','Refund completed successfully');
define('SELECT_ATLEAST_ONE_REFUND','Please select at least one refund.');
define('REFUND_COMPLETE_EMAIL_SUBJECT','Refund completed.');

define('WIDTHDRAW_REQUEST_SEND_NOTIFCATION_MSG','You had send a request to widthdraw amount');
define('YOURS_SINCERELY','Yours sincerely,');
define('CASHVERTISE_SUPPORT_TEAM','Support Team');
define('MSG_REQUEST_APPROVED_SUCCESS','Request(s) approved successfully');

define('WITHDRAW_REQUEST_APPROVED_MAIL_MSG','Your withdrawal request has been approved. We will notify you again once payment has been processed successfully.');
define('WITHDRAW_REQUEST_PAID_MAIL_MSG','We have paid successfully to your designated account. Please check and do not hesitate to contact us if you have any queries.');

define('WITHDRAW_REQUEST_APPROVE_SUCCESS_MSG','Request approved successfully.');
define('WITHDRAW_REQUEST_APPROVE_MSG_TITLE','Are you sure you want to approve this withdraw request?');
define('WITHDRAW_REQUEST_APPROVE_TITLE','Withdraw Request?');


define('WITHDRAW_REQUEST_PAID_MSG_TITLE','Are you sure you have paid this withdraw request?');
define('WITHDRAW_REQUEST_PAID_SUCCESS_MSG','Approved requests paid successfully');
define('SELECT_IMAGES_VALIDATION','Please ensure that the image for each page has been uploaded');
define('PROFILE_UPDATE_SUCCESS','Profile Updated Successfully.');
define('REPLY_SENT_SUCCESS','Reply sent successfully.');
define('UPDATE_SUCCESS_MSG','Updated successfully.');

//https://www.sglocate.com/api/json/searchwithpostcode.aspx
define('ACTION_COMPLETE_DELETE_ADVERTISER_TITLE','Delete Advertiser?');
define('ACTION_COMPLETE_DELETE_ADVERTISER_HEADING','Are you sure you want to delete the advertiser.');


define('ORDER_CANCELLED_BY_ADMIN','Order is cancelled by the admin and refund request has been initiated.');
define('ORDER_CANCELLED_BY_ADVERITSER','Order is cancelled by the adver2ser and refund request has been initiated.');
define('ORDER_CANCELLED_AFTER_COMPLETE','Order is cancelled by the admin and refund request has been initiated.');
define('ORDER_CANCEL_INITIATED_REFUND_REQUEST_DESCRIPTION','Order is cancelled by the advertiser and refund request has been initiated.');
define('ORDER_COMPLETE_INITIATED_REFUND_REQUEST_DESCRIPTION','Order is completed and refund request has been initiated.');




/*keys */
define('FIREBASE_PUSH_KEY',"AAAA74eDNQY:APA91bHKrs31DmF7kZUIdzYut4JQ7tV8pRmmlUDWPJdYkkPHsgNyF9vB9hSCZgMnlZgzwOtzFm9-dYfHjrYvMk2z1GkyQq_kT1Noem-YNvjzGd3N1yGIiuqQ1S2UXB5eOsoUjzxulqJd");
define('SG_LOCATE_API_KEY',"36599D1796E34321868F2316D280A50912586D332A1B4F78881C15B2032DB9D9");
define('SG_LOCATE_API_SECRET',"4BA0255A61EF420A9E161789C8104A3BDEE72F22A8344B87A46752A99014FFE2");
define('SG_LOCATE_API_URL',"https://www.sglocate.com/api/json/searchwithpostcode.aspx");
define('NOTIFICATION_TITLE',"CashVertise");
define('NEW_AD_POSTED',"New CashVertisement is in!");
define('GOOGLE_MAP_API_KEY',"AIzaSyBMeecfJVY32Ua2N3qyGaYwxxDU0i-g8Rw");


define('RADIUS_DISTENCE',500); // in meters


define('WITHDRAW_REQUEST_CANCEL','We have cancelled your withdraw request');
define('WITHDRAW_REQUEST_CANCEL_MAIL_MSG','Your withdrawal request has been cancelled. If you did not request us to cancel your withdrawal, please email to <a href = "mailto: support@cashvertise.com.sg">support@cashvertise.com.sg</a> to alert us.');



define('STRIP_PUBLISH_KEY',"pk_test_51JI7t2BcgyF9MdihoS2Et9clj2wQxYTTt1Amv9ruSLZnyPJUJiCxSV5anWIEstctCQqx3GAnzPJF6tZkTmY21yVW00Fg0TljkA"); 
define('STRIP_SERVER_KEY',"sk_test_51JI7t2BcgyF9MdihA6RvszxL3hsdrEiyJoSqgyJ8hgtxJvXLkFjgA34XR0Hl81FhcmkhF66p2cI6kR6WXXZLFFuJ00elsLYtfe"); 

// 4242424242424242 success payment
// 4000000000009995 fail payment
// 4000002500003155 require authentification payment


//AIzaSyCke7wlSD20mtkzKqV7bmSY20GLgX6OUt8
/*keys */

