<?php
require_once  __DIR__.DIRECTORY_SEPARATOR.'ExchangeAndroidClasses\TaskController.php';
require_once  __DIR__.DIRECTORY_SEPARATOR.'ExchangeAndroidClasses\DB_MobileUser.php';
$cont = new ExchangeAndroidClasses\TaskController();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// test of DB_MobileUSer

echo '<br>';
$user = new ExchangeAndroidClasses\DB_MobileUser();


$u["user_id"] = 50;
$u["user_login"] = "sergo";
$u["user_email"] = "sergo3030@mail.ru";
$u["user_password"] = "password";
$u["user_date_registration"] =time();



echo '<br>';

$u = FALSE;
//test of DB_User_Task


/*
$u["task_type"] = "waypoint";
$u["user_id"] = $user->getUser_id();
$u["task_file_name"] = "task file name";
$u["task_instruction"] ="task_instruction";
$u["task_image_small"] = NULL;
$u["task_image_large"] = NULL;
$u["task_date_create"] = time();
$u["task_date_last_modify"] = time();
$u["task_date_last_use"] = time();
$u["task_usage_count"] = 555;
$u["task_is_favorite"] = 1;
*/
echo '<br>';




