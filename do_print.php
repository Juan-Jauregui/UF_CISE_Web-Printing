#!/usr/local/bin/php

<?php
//echo phpversion(); //Are you kidding me CISE, 5.2.9? Jesus

/* Get real path just to be safe */
$real_path = realpath(dirname(__FILE__));

/* Include the necessary password-hashing library  */
include_once($real_path."/print_stuff/passHashLib.php");

/* Read the auth file and make it into an associative array, $users_db_arr */
$users_db_str = file_get_contents($real_path."/print_stuff/authorized_users.json");
$users_db_arr = json_decode($users_db_str,true);

$hashed_pw = $users_db_arr[$_POST["username"]];
$is_auth = check_password($_POST["password"],$hashed_pw);

if($is_auth){
	if(!isset($_POST["not_evil"]))
	printf("You must be not evil to use this service.\n");
	else {

		//$target_location = $real_path."/print_stuff/uploads/".$_FILES['upload']['name']
		//echo "Target location: "$target_location;
		$temp_location = $_FILES["upload"]["tmp_name"];
		$final_location = $real_path."/print_stuff/uploads/".$_FILES["upload"]["name"];

		if (move_uploaded_file($temp_location, $final_location)) {
			echo "File is valid, and was successfully uploaded.\n";
		} else {
			echo "Possible file upload attack!\n";
		}

	}
} else printf("\nUnauthorized");


?>
