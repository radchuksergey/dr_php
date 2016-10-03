<?php
namespace ExchangeAndroidClasses;

require_once __DIR__.DIRECTORY_SEPARATOR.'Controller.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_UserOperator.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_TaskOperator.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskController
 *
 * @author Radchuk
 */


class TaskController extends \ExchangeAndroidClasses\Controller{
   
   
    private $user_operator ;
    private $task_operator;
    
    function __construct() {
       $this->user_operator = new DB_UserOperator();
       $this->task_operator = new DB_TaskOperator();
    }

    protected function isUserValid($http_request,&$db_error){
        
        $user = new DB_MobileUser();        
        if (isset($http_request[self::USER])){
            $user->setObjectFieldsFromJson($http_request[self::USER]);
        }
        $db_user = $this->user_operator->getUserById($user->getUser_id(), $db_error);
        if ($db_user->getCheckSum() == $user->getCheckSum()){
            return $db_user;
        }
        else {
            return FALSE;
        }
        
    }
    
    public function executeRequest($http_request) {
        if (isset($http_request[self::ACTION])){
            if($http_request[self::ACTION] == self::CREATE_TASK){
                return $this->createTask($http_request);
            }
            if($http_request[self::ACTION] == self::DELETE_TASK){
                return $this->deleteTask($http_request);
            }
            if($http_request[self::ACTION] == self::TASK_LIST){
                return $this->getTaskList($http_request);
            }
            if($http_request[self::ACTION] == self::UPDATE_TASK){
                return $this->updateTask($http_request);    
            }
        }
        
    }
    
    protected function createTask($http_request){
        $db_error = FALSE;
        $result = '';
        $task = FALSE;
        if($this->isUserValid($http_request, $db_error)){
            $task = new DB_UserTask();
            if (isset($http_request[self::TASK])){
                $task->setObjectFieldsFromJson($http_request[self::TASK]);
                $this->task_operator->insertTask($task, $db_error);
                $result[self::TASK] = $task->getObjectAsJson();
            }
        }
        else{
            $result[self::TASK] = FALSE;                
        }    
        
        $result[self::ERRORS] = $db_error;
        return json_encode($result);    
    }
    
    protected function deleteTask($http_request){
        $deleted = FALSE;
        $result = '';
        $db_error = FALSE;
        if($this->isUserValid($http_request,$db_error)){ 
           if(isset($http_request[self::TASK])){
            $task =new DB_UserTask();
            $task->setObjectFieldsFromJson($http_request[self::TASK]);
            $deleted =  $this->task_operator->deleteTask($task->getTask_id(), $db_error);
           }
        }
        $result[self::DELETED] = $deleted;
        $result[self::ERRORS] = $db_error;
        return json_encode($result);
    }
    
    protected function updateTask($http_request){
        $updated = FALSE;
        $db_error = FALSE;
        if($this->isUserValid($http_request,$db_error)){ 
           if(isset($http_request[self::TASK])){
                $task =new DB_UserTask();
                $task->setObjectFieldsFromJson($http_request[self::TASK]);
                $updated =  $this->task_operator->updateTask($task, $db_error);
           }
        }
        $result[self::UPDATED] = $updated;
        $result[self::ERRORS] = $db_error;
        return json_encode($result);
    }
    
    protected function getTaskList($http_request){
        $db_error = FALSE;
        $user = $this->isUserValid($http_request, $db_error);
        $json_tasklist = FALSE;
        if ($user){
            $tasklist = $this->task_operator->getTaskListByUserID($user->getUser_id(), $db_error);
            if($tasklist){
                $json_tasklist = '';
                for($i = 0; $i < count($tasklist); $i++){
                    $task = $tasklist[$i];
                    $json_tasklist[$i] = $task->getObjectAsJson();
                }
               
            }
        }
        $result[self::TASK_LIST] = json_encode($json_tasklist);
        $result[self::ERRORS] = $db_error;
        $result = json_encode($result);
        return $result;
    }

}
	