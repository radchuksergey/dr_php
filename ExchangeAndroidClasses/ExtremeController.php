<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ExchangeAndroidClasses;
require_once __DIR__.DIRECTORY_SEPARATOR.'Controller.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_UserOperator.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_TaskOperator.php';

/**
 * Description of ExtremeController
 *
 * @author sergey
 */
class ExtremeController extends Controller{
    
    /**
     *
     * @var DB_TaskOperator 
     */
    private $dbTaskOperator ;
    
    /**
     *
     * @var DB_UserOperator 
     */
    private $dbUserOperator ;
    
    function __construct() {
       $this->dbUserOperator = new DB_UserOperator();
       $this->dbTaskOperator = new DB_TaskOperator();
    }
    
    protected function isUserValid($http_request,&$db_error){
        
        $user = new DB_MobileUser();        
        if (isset($http_request[self::USER])){
            $user->setObjectFieldsFromJson($http_request[self::USER]);
        }
        
        $db_user = $this->dbUserOperator->getUserById($user->getUser_id(), $db_error);
       if(($db_user->getUser_id()) && ($db_user->isPaswordCorrect($user->getUser_password()))){
           return $db_user;
       }
        else {
            return FALSE;
        }
        
    }
    
    public function executeRequest($http_request) {
        if(isset($http_request[self::USER])){
            $db_error = FALSE;
            $dbTaskOperator = new DB_TaskOperator();
            $dbUserOperator = new DB_UserOperator();
            
            /*
             * @var DB_MobileUser
             */
            $user = $this->isUserValid($http_request, $db_error);
            if($user){
                $resultDeleteTasks = $dbTaskOperator->deleteAllTasksByUserId($user->getUser_id(),$db_error);
                if (($resultDeleteTasks) && (!$db_error)){
                    $resultDeleteUser = $dbUserOperator->deleteUserById($user->getUser_id(), $db_error);
                    $result[self::DELETED] = $resultDeleteUser;
                    $result[self::ERRORS] = $db_error;
                    
                }
                else{
                    $result[self::DELETED] = $resultDeleteTasks;
                    $result[self::ERRORS] = $db_error;    
                }   
            }
            else{
                $result[self::DELETED] = FALSE;
                $result[self::ERRORS] = self::ERROR_PASSWORD_USER_INCORRECT;    
            }
            return json_encode($result);
        }
    }

   

//put your code here
}
