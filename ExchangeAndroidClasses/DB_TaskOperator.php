<?php
namespace ExchangeAndroidClasses;

require_once __DIR__.DIRECTORY_SEPARATOR.'DB_Connector.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_UserTask.php';



use ExchangeAndroidClasses\DB_UserTask;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB_TaskOperator
 *
 * @author sergey
 */
class DB_TaskOperator extends \ExchangeAndroidClasses\DB_Connector{
    
    private function createTaskFromDbRecord($db_record){
        $task = new DB_UserTask();
        $task->setUser_id($db_record["user_id"]);
        $task->setTask_id($db_record["task_id"]);
        $task->setTask_file_name($db_record["task_file_name"]);
        $task->setTask_instruction($db_record["task_instruction"]);
        $task->setTask_image_small($db_record["task_image_small"]);
        $task->setTask_image_large($db_record["task_image_large"]);
        $task->setTask_date_create($db_record["task_date_create"]);
        $task->setTask_date_last_modify($db_record["task_date_last_modify"]);
        $task->setTask_date_last_use($db_record["task_date_last_use"]);
        $task->setTask_usage_count($db_record["task_usage_count"]);
        $task->setTask_is_favorite($db_record["task_is_favorite"]); 
        $task->setTask_type($db_record["task_type"]);
        return $task;
    }
    
    public function getTaskById($task_id, &$db_error){
        $sqlStatement = "SELECT `user_id`,`task_id` ,`task_file_name`,".
                " `task_instruction`, `task_image_small`, `task_image_large`,".
                " `task_date_create`, `task_date_last_modify`, `task_date_last_use`,".
                " `task_usage_count`, `task_is_favorite`, `task_type` FROM `user_task_table` WHERE `task_id` = '{TASK_ID}' ";
        $sqlStatement = str_replace("{TASK_ID}", $task_id, $sqlStatement);
        $db_result = $this->executeSQL($sqlStatement, $db_error);
        $task = FALSE;
        if($db_result && ($db_result->num_rows > 0)){
            $row = mysqli_fetch_assoc($db_result);
            $row['task_id'] = intval($row['task_id']);
            $row['user_id'] = intval($row['user_id']);
            $task = new DB_UserTask();
            $task->setAllFromArray($row);
        }
        $this->closeConnection();
        return $task;
        
    }
    
    public function getTaskByName($task_name,$user_id, &$db_error){
        $sqlStatement = "SELECT `user_id`,`task_id` ,`task_file_name`,".
                " `task_instruction`, `task_image_small`, `task_image_large`,".
                " `task_date_create`, `task_date_last_modify`, `task_date_last_use`,".
                " `task_usage_count`, `task_is_favorite`,`task_type` FROM `user_task_table` WHERE `task_file_name` = '{TASK_FILENAME}' ".
                "AND `user_id` = '{USERID}'";
        $sqlStatement = str_replace("{TASK_FILENAME}", $task_name, $sqlStatement);
        $sqlStatement = str_replace("{USERID}", $user_id, $sqlStatement);
        $db_result = $this->executeSQL($sqlStatement, $db_error);
        $task = FALSE;
        if($db_result && ($db_result->num_rows > 0)){
            $row = mysqli_fetch_assoc($db_result);
            $row['task_id'] = intval($row['task_id']);
            $row['user_id'] = intval($row['user_id']);
            $task = new DB_UserTask();
            $task->setAllFromArray($row);
        }
        $this->closeConnection();
        return $task;
        
    }
    
    public function getTaskListByUserID($user_id, &$db_error){
        $sqlStatement = "SELECT `user_id`,`task_id` ,`task_file_name`,".
                " `task_instruction`, `task_image_small`, `task_image_large`,".
                " `task_date_create`, `task_date_last_modify`, `task_date_last_use`,".
                " `task_usage_count`, `task_is_favorite`,`task_type` FROM `user_task_table` WHERE ".
                " `user_id` = '{USERID}'";
        $sqlStatement = str_replace("{USERID}", $user_id, $sqlStatement);
        $tasklist = FALSE;
        $db_result = $this->executeSQL($sqlStatement, $db_error);
        if ($db_result and ($db_result->num_rows > 0)){
            $i = 0;
            while ($row = mysqli_fetch_assoc($db_result)) {
                $task = new DB_UserTask();
                $task->setAllFromArray($row);
                $tasklist[$i] = $task;
                $i++;
            }
        }
        $this->closeConnection();
        return $tasklist;     
    }
    
    public function updateTask(DB_UserTask $userTask, &$db_error){
        $sql_statement = "UPDATE `user_task_table` SET `user_id`='{user_id}',`task_file_name`='{task_file_name}',".
                "`task_type`='{task_type}',`task_status`='{task_status}',`task_instruction`='{task_instruction}',`task_image_small`='{task_image_small}',".
                "`task_image_large`='{task_image_large}',`task_date_create`='{task_date_create}',`task_date_last_modify`='{task_date_last_modify}',".
                "`task_date_last_use`='{task_date_last_use}',`task_usage_count`='{task_usage_count}',`task_is_favorite`='{task_is_favorite}' WHERE `task_id`='{task_id}'";
        $sql_statement = str_replace("{user_id}", $userTask->getUser_id(), $sql_statement);
        $sql_statement = str_replace("{task_file_name}", $userTask->getTask_file_name(), $sql_statement);
        $sql_statement = str_replace("{task_type}", $userTask->getTask_type(), $sql_statement);
        $sql_statement = str_replace("{task_instruction}", $userTask->getTask_instruction(), $sql_statement);
        $sql_statement = str_replace("{task_image_small}", $userTask->getTask_image_small(), $sql_statement);
        $sql_statement = str_replace("{task_image_large}", $userTask->getTask_image_large(), $sql_statement);
        $sql_statement = str_replace("{task_date_create}", $userTask->getTask_date_create(), $sql_statement);
        $sql_statement = str_replace("{task_date_last_modify}", $userTask->getTask_date_last_modify(), $sql_statement);
        $sql_statement = str_replace("{task_date_last_use}", $userTask->getTask_date_last_use(), $sql_statement);
        $sql_statement = str_replace("{task_usage_count}", $userTask->getTask_usage_count(), $sql_statement);
        $sql_statement = str_replace("{task_is_favorite}", $userTask->getTask_is_favorite(), $sql_statement);
        $sql_statement = str_replace("{task_id}", $userTask->getTask_id(), $sql_statement);
        $db_result = $this->executeSQL($sql_statement, $db_error);
        $this->closeConnection();
        return $db_result;
        
    }
    
    public function insertTask(DB_UserTask $userTask, &$db_error){
        $sqlStatement = "INSERT INTO `user_task_table`(`user_id`, `task_file_name`, `task_type`, `task_instruction`, ".
                "`task_image_small`, `task_image_large`, `task_date_create`,`task_date_last_modify`, `task_date_last_use`,".
                " `task_usage_count`, `task_is_favorite`) VALUES ('{user_id}','{task_file_name}','{task_type}','{task_instruction}',".
                "'{task_image_small}','{task_image_large}','{task_date_create}','{task_date_last_modify}','{task_date_last_use}',".
                "'{task_usage_count}','{task_is_favorite}')";
        $sqlStatement = str_replace("{user_id}", $userTask->getUser_id(), $sqlStatement);
        $sqlStatement = str_replace("{task_file_name}", $userTask->getTask_file_name(), $sqlStatement);
        $sqlStatement = str_replace("{task_type}", $userTask->getTask_type(), $sqlStatement);
        $sqlStatement = str_replace("{task_instruction}", $userTask->getTask_instruction(), $sqlStatement);
        $sqlStatement = str_replace("{task_image_small}", $userTask->getTask_image_small(), $sqlStatement);
        $sqlStatement = str_replace("{task_image_large}", $userTask->getTask_image_large(), $sqlStatement);
        $sqlStatement = str_replace("{task_date_create}", $userTask->getTask_date_create(), $sqlStatement);
        $sqlStatement = str_replace("{task_date_last_modify}", $userTask->getTask_date_last_modify(), $sqlStatement);
        $sqlStatement = str_replace("{task_date_last_use}", $userTask->getTask_date_last_use(), $sqlStatement);
        $sqlStatement = str_replace("{task_usage_count}", $userTask->getTask_usage_count(), $sqlStatement);
        $sqlStatement = str_replace("{task_is_favorite}", $userTask->getTask_is_favorite(), $sqlStatement);
        $insert_result = $this->executeInsertSQL($sqlStatement, $db_error);
        if($insert_result){
            $userTask->setTask_id($insert_result);
        }
        $this->closeConnection();     
    }
    
    public function deleteTask($task_id,&$db_error){
        $sql_statement = "DELETE FROM `user_task_table` WHERE `task_id` = '{task_id}'";
        $sql_statement = str_replace("{task_id}", $task_id, $sql_statement);
        $db_result = $this->executeSQL($sql_statement, $db_error);
        $this->closeConnection();
        return $db_result;
    }


}
