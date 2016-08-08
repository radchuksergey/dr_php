<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRegistrator
 *
 * @author sergey
 */

use Action_Executor;

class UserRegistrator extends Action_Executor{
    private $Error_user_exists = "user already exist";
 
    private function  getFalseResultArray(){
        $result_array["user_id"] = FALSE;
        $result_array["user_login"] = FALSE;
        $result_array["user_email"] = FALSE;
        $result_array["db_error"] = FALSE;
        $result_array["comments"] = FALSE;
        return $result_array;
    }
    
    private function  getUserResultArray(DB_MobileUser $user){
        $result_array["user_id"] = $user->getUser_id();
        $result_array["user_login"] = $user->getUser_login();
        $result_array["user_email"] = $user->getUser_email();
        $result_array["db_error"] = FALSE;
        $result_array["comments"] = FALSE;
        return $result_array;
    }

    

    public function executeRequest($http_request){
        $userlogin = "";
        $userEmail = "";
        $userPassword = "";
        $error = "";
        $user_operator = new DB_UserOperator();
        if (isset($http_request["userlogin"])){
            $userlogin = $http_request["userlogin"];
        }
        if(isset($http_request["useremail"])){
            $userEmail = $http_request["useremail"];
        }
        if(isset($http_request["userPassword"])){
            $userPassword = $http_request["userpassword"];
        }
        $existed_user = $user_operator->getUserByEmail($userEmail, $error);
        if ($existed_user){
            $result_array = $this->getFalseResultArray();
            $result_array["comments"] = $this->Error_user_exists;
        }else{
            $registration_complete = $user_operator->createUser($userlogin, $userPassword, $userEmail, $error);
            if($registration_complete){
                $user = $user_operator->getUserByEmail($userEmail, $error);
                if($user){
                    $result_array = $this->getUserResultArray($user);
                }else{
                    $result_array = $this->getFalseResultArray();
                    $result_array["db_error"] = $error;
                }
            }
        }
       
        echo json_encode($result_array);
             
    }
}
