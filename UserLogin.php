<?php

use Action_Executor;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserLogin
 *
 * @author sergey
 */
class UserLogin extends Action_Executor{
   

        public function executeRequest($http_request) {
        $user_operator = new DB_UserOperator();
        $userEmail = "";
        $userPassword = "";
        $result_array = "";
        $error = "";
        
        if(isset($http_request["useremail"])){
            $userEmail = $http_request["useremail"];
        }
        if(isset($http_request["userPassword"])){
            $userPassword = $http_request["userpassword"];
        }
        $user_operator->getUserByEmail($userEmail, $error);
        
        if(($user) && ($user->isPaswordCorrect($userPassword))){
            
            $result_array["user_id"] = $user->getUser_id();
            $result_array["user_login"] = $user->getUser_login();
            $result_array["user_email"] = $user->getUser_email();
            $result_array["db_error"] = $error;
        }
        else{
            $result_array["user_id"] = FALSE;
            $result_array["user_login"] = FALSE;
            $result_array["user_email"] = FALSE;
            $result_array["db_error"] = $error;
        }
        
        $result = json_decode($result_array);
        echo $result;
        
    }

//put your code here
}
