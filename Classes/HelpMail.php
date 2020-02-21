<?php
class HelpMail{
function SendHelpMail($con_name, $con_email, $con_sub, $con_text){
require 'connect.inc.php';
   
		$to='k142039@nu.edu.pk';
		$subject=$con_sub;
		$body=$con_name."\n".$con_text;
		$headers='From: '.$con_email;
		if(mail($to,$subject,$body,$headers)){
			echo "Thanks for contacting us, We'll be in touch soon.";
}
}
}
?>