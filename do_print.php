#!/usr/local/bin/php

<?php
//echo phpversion(); //Are you kidding me CISE, 5.2.9? Jesus

/* Get real path */
$real_path = realpath(dirname(__FILE__));

/* For SSH */
set_include_path($real_path.'/lib/phpseclib1.0.5');
include_once("Net/SSH2.php");

$ssh = new Net_SSH2('storm.cise.ufl.edu');
if (!$ssh->login($_POST["username"], $_POST["password"])) {
	 exit('Login Failed');
} else {
	if($_FILES["upload"]["size"] > 0){
		echo "<pre>".$ssh->exec("lpstat -p | grep ".$_POST["printer"])."</pre>";
		exec("mkdir -p ./temp_file_bin");//Temp file storage while printing
		$temp_location = $_FILES["upload"]["tmp_name"];
		$final_location = "$real_path/temp_file_bin/".$_FILES["upload"]["name"];

		if (move_uploaded_file($temp_location, $final_location)) {
			echo "File is valid, and was successfully uploaded.\n\nPrinting...\n\n";
			echo "<pre>".$ssh->exec("lp -d ".$_POST["printer"]." -n ".$_POST["quantity"]." ".$final_location)."</pre>";
			//echo "<pre>".("lp -d ".$_POST["printer"]." -n ".$_POST["quantity"]." ".$final_location)."</pre>";
		} else echo "File failed to upload";

		exec("rm -r ./temp_file_bin");//Get rid of the temp folder

	} else printf("\nNo file uploaded\n");
	printf( "\n<a href=\"./print.php\"><button>Back</button></a>");

}

?>
