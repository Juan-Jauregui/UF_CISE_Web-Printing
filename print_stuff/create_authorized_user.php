<?php
//echo phpversion(); //Are you kidding me CISE, 5.2.9? Jesus

if(sizeof($argv) != 3) echo "Usage: php create_authorized_user <new_username> <new_password>\n";
else {
	//Get real path, as authorized_users.json is relative to script location
	$real_path = realpath(dirname(__FILE__));

	/* Include the necessary password-hashing library  */
	include_once($real_path."/passHashLib.php");

	//Read the auth file and make it into an associative array, $users_db_arr
	$users_db_str = file_get_contents($real_path."/authorized_users.json");
	$users_db_arr = json_decode($users_db_str,true);

	//Will be the index by which users are found
	$new_user = $argv[1];

	//If the user already exists, ask if it's cool to overwrite it.
	if(isset($users_db_arr[$new_user]))
	if(readline("User already exists. Overwrite? (y/n)\n") != "y")
	exit(1);	//If the response wasn't "y", exit.

	//Hash the password before storing it
	printf("Salting and hashing password...\n");
	$new_password = hash_password($argv[2]);

	printf("Adding $new_user to the list of authorized users...\n");
	//Add an entry in the array for the new user with the hashed password
	$users_db_arr[$new_user] = $new_password;

	//Turn array back into string
	$users_db_str = json_encode($users_db_arr);

	printf("Saving authorized_users list...\n");
	//Write it back to the file
	$success = fwrite(fopen($real_path."/authorized_users.json","w"),$users_db_str);

	if($success) echo "Success!\n";
	else echo "ERROR";
}


?>
