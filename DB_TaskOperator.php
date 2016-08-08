<?php



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
class DB_TaskOperator extends DB_Connector{
    
    public function getTaskById(string $task_id, &$db_error){
        $sqlStatement = "SELECT `user_id`,`task_id` ,`task_file_name`, `task_guid`,".
                " `task_instruction`, `task_image_small`, `task_image_large`,".
                " `task_date_create`, `task_date_last_modify`, `task_date_last_use`,".
                " `task_usage_count`, `task_is_favorite` FROM `user_task_table` WHERE `task_id` = {TASK_ID}";
        
    }
    
    public function getTaskByName(string $task_name,string $user_id, &$db_error){
        
    }
    
    public function getTaskListByUserID(string $user_id){
        
    }
     
    public function insertTask(DB_UserTask $userTask){
         
    }
    
    public function deleteTask(){
        
    }


}
