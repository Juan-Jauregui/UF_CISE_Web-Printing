#!/usr/local/bin/php

<?php
      //Get parameters from POST
      $submitted_user = $_POST["username"];
      $submitted_pass = $_POST["password"];

      //Read the auth file and make it into an associative array, $users_db_arr
      $users_db_str = file_get_contents("./print_stuff/authorized_users.json");
      $users_db_arr = json_decode($users_db_str,true);

      $is_auth = password_verify(
         $submitted_pass,
         $users_db_arr[$submitted_user]
      );

      echo ($is_auth)? "Authorized":"Not Authorized";
?>
