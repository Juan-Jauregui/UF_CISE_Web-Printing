#!/usr/local/bin/php

<?php
/* Get real path */
$real_path = realpath(dirname(__FILE__));

/* For SSH */
set_include_path($real_path.'/lib/phpseclib1.0.5');
include_once("Net/SSH2.php");

/* Create an SSH connection using the provided credentials */
$ssh = new Net_SSH2('storm.cise.ufl.edu');
if (!$ssh->login($_POST["username"], $_POST["password"])) {
	/* If SSH fails, say that */
	printf('Login Failed');
} else {
	/* If a file was uploaded */
	if($_FILES["upload"]["size"] > 0){
		/* Print the printer's status just for info */
		echo "<pre>".$ssh->exec("/usr/local/bin/printquota")."</pre>";
		echo "<pre>".$ssh->exec("lpstat -p | grep ".$_POST["printer"])."</pre>";

		/* Make a temporary directory to store the file */
		exec("mkdir -p ./temp_file_bin");

		/* Move the file to the temp folder*/
		$temp_location = $_FILES["upload"]["tmp_name"];
		$final_location = "$real_path/temp_file_bin/".$_FILES["upload"]["name"];
		if (move_uploaded_file($temp_location, $final_location)) {
			echo "File is valid, and was successfully uploaded.\n\nPrinting...\n\n";
			/* Use lp to print the given number of copies of the file to the given printer */
			echo "<pre>".$ssh->exec("lp -d ".$_POST["printer"]." -n ".$_POST["quantity"]." ".$final_location)."</pre>";
			//echo "<pre>".("lp -d ".$_POST["printer"]." -n ".$_POST["quantity"]." ".$final_location)."</pre>";
		} else echo "File failed to upload";

		/* Get rid of the temp folder (along with the file in it) */
		exec("rm -r ./temp_file_bin");

	} else printf("\nNo file uploaded\n");
}
/* Button to return to the print page */
printf( "\n<a href=\"./print.php\"><button>Back</button></a>");


?>
#!/usr/local/bin/php

<?php
/* Get real path */
$real_path = realpath(dirname(__FILE__));

/* For SSH */
set_include_path($real_path.'/lib/phpseclib1.0.5');
include_once("Net/SSH2.php");

/* Create an SSH connection using the provided credentials */
$ssh = new Net_SSH2('storm.cise.ufl.edu');
if (!$ssh->login($_POST["username"], $_POST["password"])) {
	/* If SSH fails, say that */
	printf('Login Failed');
} else {
	/* If a file was uploaded */
	if($_FILES["upload"]["size"] > 0){
		/* Print the user's print quota */
		echo "<pre>".$ssh->exec("/usr/local/bin/printquota")."</pre>";

		/* Print the printer's status just for info */
		echo "<pre>".$ssh->exec("lpstat -p | grep ".$_POST["printer"])."</pre>";

		/* Make a temporary directory to store the file */
		exec("mkdir -p ./temp_file_bin");

		/* Move the file to the temp folder*/
		$temp_location = $_FILES["upload"]["tmp_name"];
		$final_location = "$real_path/temp_file_bin/".$_FILES["upload"]["name"];
		if (move_uploaded_file($temp_location, $final_location)) {
			echo "File is valid, and was successfully uploaded.\n\nPrinting...\n\n";
			/* Use lp to print the given number of copies of the file to the given printer */
			echo "<pre>".$ssh->exec("lp -d ".$_POST["printer"]." -n ".$_POST["quantity"]." ".$final_location)."</pre>";

			/*DEBUG: Don't print, just output the command that would be executed
			 echo "<pre>".("lp -d ".$_POST["printer"]." -n ".$_POST["quantity"]." ".$final_location)."</pre>";*/
		} else echo "File failed to upload";

		/* Get rid of the temp folder (along with the file in it) */
		exec("rm -r ./temp_file_bin");

	} else printf("\nNo file uploaded\n");
}
/* Button to return to the print page */
printf( "\n<a href=\"./print.php\"><button>Back</button></a>");


?>
