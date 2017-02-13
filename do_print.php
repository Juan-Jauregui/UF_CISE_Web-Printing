#!/usr/local/bin/php

<?php
//Get real path just to be safe
$real_path = realpath(dirname(__FILE__));

//Read the auth file and make it into an associative array, $users_db_arr
$users_db_str = file_get_contents($real_path."/print_stuff/authorized_users.json");
$users_db_arr = json_decode($users_db_str,true);

$is_auth = FALSE;
if (isset($_POST["username"]) && isset($_POST["password"])) {
   $hashed_pw = $users_db_arr[$_POST["username"]];
   if(isset($hashed_pw)){
      //printf("password_verify(".$_POST["password"].",".$hashed_pw.")");
      var_dump($_POST["password"]);
      var_dump($hashed_pw);

      try{
         $is_auth = password_verify($_POST["password"],$hashed_pw);
      } catch (Exception $e) {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
   }
}

if($is_auth){
   printf("Authorized");
} else printf("Unauthorized");


?>
