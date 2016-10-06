<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ExchangeAndroidClasses;
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_MobileUser.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserOperator.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserTask.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_TaskOperator.php';

/**
 * Description of TestHelper
 *
 * @author sergey
 */
class TestHelper {
    /**
     * @var DB_UserOperator
     */
    protected $db_UserOperator;
    /**
     * @var DB_TaskOperator
     */
    protected $db_TaskOperator;
    
    function __construct() {
        $this->db_TaskOperator = new DB_TaskOperator();
        $this->db_UserOperator = new DB_UserOperator();
    }
    
    /**
     * @return DB_MobileUser $user
     */
    public function createUser(){
        /**
         * @var DB_MobileUser Description
         */
        $user = new DB_MobileUser();
        $user->setUser_email("sergo3030@mail.ru");
        $user->setUser_login("jarjarbinks");
        $user->setUser_password("123456");
        $this->db_UserOperator->createUser($user, $db_error);
        if ($db_error == FALSE){
            $user->setUser_password("123456");
            return $user;
        }            
        else{
            return FALSE;
        }
    }
    
     /**
     * @
     * @param DB_MobileUser $user
     * @return boolean $db_error
     */
    public function createTaskListInDB($user){
        $db_error = FALSE;
        for ($i = 0; $i < 5; $i++){
            $data = date('Y-m-d H:i:s');
            $task_array['task_type'] = 'type1';
            $task_array['user_id'] = $user->getUser_id();
            $task_array['task_file_name'] = 'filename'.$i;
            $task_array['task_instruction'] = 'instruction'.$i;
            $task_array['task_image_small'] = 'task_image_small.$i';
            $task_array['task_image_large'] = 'task_image_large'.$i;
            $task_array['task_date_create'] = $data;
            $task_array['task_date_last_modify'] = $data;
            $task_array['task_date_last_use'] = $data;
            $task_array['task_usage_count'] = 0;
            $task_array['task_is_favorite'] = 'no';
            $userTask = new DB_UserTask();
            $userTask->setAllFromArray($task_array);
            $this->db_TaskOperator->insertTask($userTask, $db_error);    
        }
        return !$db_error;
        
    }
    
}
