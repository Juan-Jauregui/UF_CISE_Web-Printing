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

$is_auth = FALSE;
/* Auth defaults to false. Will flip to true only if password checks out. */

/* If username and password were provided */
if (isset($_POST["username"]) && isset($_POST["password"])) {
	/* Try and grab the entry from authorized_users matching the given user */
	$hashed_pw = $users_db_arr[$_POST["username"]];

	/* If a user with that username exists, try and verify its password */
	if(isset($hashed_pw)){
		$is_auth = password_verify("".$_POST["password"],"".$hashed_pw);
	}
}

if($is_auth){
	printf("\nAuthorized");
} else printf("\nUnauthorized");


?>
