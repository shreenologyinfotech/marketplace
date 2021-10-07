<?php
if(isset($login)){
	include_once("header-plain.php");
	include_once($page);
	include_once("footer-plain.php");

}else{
	
	include_once("header.php");
	include_once($page);
	include_once("footer.php");
}
?>
 
  