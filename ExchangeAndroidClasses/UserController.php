<?php
namespace ExchangeAndroidClasses;
require_once __DIR__.DIRECTORY_SEPARATOR.'Controller.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Radchuk
 */
class UserController extends \ExchangeAndroidClasses\Controller {
    
    
    
    
    protected function registerUser($http_request){
        $userlogin = "";
        $userEmail = "";
        $userPassword = "";
        $error = FALSE;
        $user_operator = new DB_UserOperator();
        
        if (isset($http_request["userlogin"])){
            $userlogin = $http_request["userlogin"];
        }
        if(isset($http_request["useremail"])){
            $userEmail = $http_request["useremail"];
        }
        if(isset($http_request["userpassword"])){
            $userPassword = $http_request["userpassword"];
        }
        $existed_user = $user_operator->getUserByEmail($userEmail, $error);
        $registered_user = new DB_MobileUser();
        if (!$existed_user->getUser_id()){
            $registered_user->setUser_email($userEmail);
            $registered_user->setUser_login($userlogin);
            $registered_user->setUser_password($userPassword);
            $user_operator->createUser($registered_user, $error);
        } 
        else{
            $error = self::ERROR_USER_EXIST;
        }
        $result[self::USER] = $registered_user->getObjectAsJson();
        $result[self::ERRORS] = $error;
        return json_encode($result);
    }
    
    protected function loginUser($http_request){
        $user_operator = new DB_UserOperator();
        $userEmail = "";
        $userPassword = "";
        $result=FALSE;
        $error = FALSE;
        
        if(isset($http_request["useremail"])){
            $userEmail = $http_request["useremail"];
        }
        if(isset($http_request["userpassword"])){
            $userPassword = $http_request["userpassword"];
        }
        $userFromDB = $user_operator->getUserByEmail($userEmail, $error); 
        if($userFromDB->getUser_id()){
            if($userFromDB->isPaswordCorrect($userPassword)){
                $result[self::USER] = $userFromDB->getObjectAsJson();
                $result[self::ERRORS] = $error;
            }
            else{
                $emptyUser = new DB_MobileUser();
                $result[self::USER] = $emptyUser->getObjectAsJson();
                $result[self::ERRORS] = self::ERROR_PASSWORD_USER_INCORRECT;
            }
        }
        else{
            $emptyUser = new DB_MobileUser();
            $result[self::USER] = $emptyUser->getObjectAsJson();
            $result[self::ERRORS] = $error;
        }
        return json_encode($result);
    }




    public function executeRequest($http_request) {
        if (isset($http_request[self::ACTION])){
            if ($http_request[self::ACTION] == self::REGISTER_ACTION){
                return $this->registerUser($http_request);
            }
            if ($http_request[self::ACTION] == self::LOGIN_ACTION){
                return $this->loginUser($http_request);
            }
        }
    }
}
