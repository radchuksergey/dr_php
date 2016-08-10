<?php

use Controller;

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
class TaskController extends Controller{
    
    const CREATE_TASK = 'create_task';
    const TASK_LIST = 'task_list';
    const UPDATE_TASK = 'update_task';
    const DELETE_TASK = 'delete_task';
   
    private $user_operator ;
    private $task_operator;
    
    function __construct() {
       $this->user_operator = new DB_UserOperator();
       $this->task_operator = new DB_TaskOperator();
    }

    function isUserValid($http_request,&$db_error){
        
        $user = new DB_MobileUser();        
        if (isset($http_request[self::USER])){
            $user->setObjectFieldsFromJson($http_request[self::USER]);
        }
        $db_user = $this->user_operator->getUserById($user->getUser_id(), $db_error);
        if ($db_user->getCheckSum() = $user->getCheckSum()){
            return $db_user;
        }
        else {
            return FALSE;
        }
        
    }
    
    public function executeRequest($http_request) {
        if (isset($http_request[self::ACTION])){
            if($http_request[self::ACTION] == self::CREATE_TASK){
                $this->createTask($http_request);
            }
            if($http_request[self::ACTION] == self::DELETE_TASK){
                $this->deleteTask($http_request);
            }
            if($http_request[self::ACTION] == self::TASK_LIST){
                $this->getTaskList($http_request);
            }
            if($http_request[self::ACTION] == self::UPDATE_TASK){
                $this->updateTask($http_request);    
            }
        }
        
    }
    
    protected function createTask($http_request,&$db_error){
        $db_error = '';
        if($this->isUserValid($http_request)){
            $task = new DB_UserTask();
            if (isset($http_request[self::TASK])){
                $task->setObjectFieldsFromJson($http_request[self::TASK]);
                $this->task_operator->insertTask($task, $db_error);
                echo $task->getObjectAsJson();
            }
        }
        else{
            return FALSE;                
        }            
        
        
    }
    
    protected function deleteTask($http_request,&$db_error){
        $deleted = FALSE;
        if($this->isUserValid($http_request)){ 
           if(isset($http_request[self::TASK])){
            $task =new DB_UserTask();
            $task->setObjectFieldsFromJson($http_request[self::TASK]);
            $deleted =  $this->task_operator->deleteTask($task->getTask_id(), $db_error);
           }
           
        }
        return $deleted;
    }
    
    protected function updateTask($http_request,&$db_error){
        $updated = FALSE;
        if($this->isUserValid($http_request)){ 
           if(isset($http_request[self::TASK])){
                $task =new DB_UserTask();
                $task->setObjectFieldsFromJson($http_request[self::TASK]);
                $updated =  $this->task_operator->deleteTask($task->getTask_id(), $db_error);
           }
        }
        return $updated;
    }
    
    protected function getTaskList($http_request,&$db_error){
        $user = $this->isUserValid($http_request, $db_error);
        $json_tasklist = FALSE;
        if ($user){
            $tasklist = $this->task_operator->getTaskListByUserID($user->getUser_id(), $db_error);
            if($tasklist){
                $json_tasklist = '';
                for($i = 0; $i < count($tasklist); $i++){
                    $task = $tasklist[i];
                    $json_tasklist[$task->getTask_id()] = $task->getObjectAsJson();
                }
               
            }
        }
        return $json_tasklist;
    }

}
