#!/usr/local/bin/php

<?php
//echo phpversion(); //Are you kidding me CISE, 5.2.9? Jesus

/* Get real path just to be safe */
$real_path = realpath(dirname(__FILE__));

/* Include the necessary password-hashing library  */
include_once($real_path."/print_stuff/passHashLib.php");

/* For SSH */
set_include_path($real_path.'/print_stuff/phpseclib1.0.5');
include_once("Net/SSH2.php");

/* Read the auth file and make it into an associative array, $users_db_arr */
$users_db_str = file_get_contents($real_path."/print_stuff/authorized_users.json");
$users_db_arr = json_decode($users_db_str,true);

$hashed_pw = $users_db_arr[$_POST["username"]];
$is_auth = check_password($_POST["password"],$hashed_pw);

if($is_auth){
	//var_dump($_FILES);
	if($_FILES["upload"]["size"] > 0){
		$temp_location = $_FILES["upload"]["tmp_name"];
		$final_location = $real_path."/print_stuff/uploads/".$_FILES["upload"]["name"];

		if (move_uploaded_file($temp_location, $final_location)) {
			echo "File is valid, and was successfully uploaded.\n";


		} else echo "File failed to upload";
	} else printf("\nNo file uploaded\n");

	$ssh = new Net_SSH2('storm.cise.ufl.edu');
	if (!$ssh->login('jj3', 'nicetry')) {
		 exit('Login Failed');
	}

	echo $ssh->exec('lpstat -p -d');

} else printf("\nUnauthorized");


?>
