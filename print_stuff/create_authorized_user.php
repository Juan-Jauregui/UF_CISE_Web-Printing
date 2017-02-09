#!/usr/local/bin/php

<?php
   if(sizeof($argv) === 3){
      //Get real path, as authorized_users.json is relative to script location
      $real_path = realpath(dirname(__FILE__));

      //Will be the index by which users are found
      $new_user = $argv[1];

      //Hash the password before storing it
      $new_password = password_hash($argv[2],PASSWORD_BCRYPT);

      //Read the auth file and make it into an associative array, $users_db_arr
      $users_db_str = file_get_contents($real_path."/authorized_users.json");
      $users_db_arr = json_decode($users_db_str,true);

      //Add an entry in the array for the new user with the hashed password
      $users_db_arr[$new_user] = $new_password;

      //Turn array back into string
      $users_db_str = json_encode($users_db_arr);

      //Write it back to the file
      $success = fwrite(fopen($real_path."/authorized_users.json","w"),$users_db_str);

      if($success){
         echo "Successfully added user ".$new_user." to the list of authorized users.\n";
      }
      else {
         echo "Encountered an ERROR";
      }
   }
   else
      echo "Usage: php create_authorized_user <new_username> <new_password>\n";

?>
