#!/usr/local/bin/php

<?php
      //Get parameters from POST
      $submitted_user = $_POST["username"];
      $submitted_pass = $_POST["password"];

      //Get real path just to be safe
      $real_path = realpath(dirname(__FILE__));

      //Read the auth file and make it into an associative array, $users_db_arr
      $users_db_str = file_get_contents($real_path."/print_stuff/authorized_users.json");
      $users_db_arr = json_decode($users_db_str,true);

      //var_dump($submitted_pass);
      //var_dump($users_db_arr[$submitted_user]);

      $is_auth = password_verify($submitted_pass,$users_db_arr[$submitted_user]);

      //If authorized, actually handle the file
      if($is_auth){

      }
?>
