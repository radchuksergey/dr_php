<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB_UserTask
 *
 * @author sergey
 */
class UserTask {
   
    private $task_id;
    private $user_id;
    private $task_file_name;
    private $task_instruction;
    private $task_image_small;
    private $task_image_large;
    private $task_date_create;
    private $task_date_last_modify;
    private $task_date_last_use;
    private $task_usage_count;
    private $task_is_favorite;
    
    function getTask_id() {
        return $this->task_id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getTask_file_name() {
        return $this->task_file_name;
    }

    function getTask_instruction() {
        return $this->task_instruction;
    }

    function getTask_image_small() {
        return $this->task_image_small;
    }

    function getTask_image_large() {
        return $this->task_image_large;
    }

    function getTask_date_create() {
        return $this->task_date_create;
    }

    function getTask_date_last_modify() {
        return $this->task_date_last_modify;
    }

    function getTask_date_last_use() {
        return $this->task_date_last_use;
    }

    function getTask_usage_count() {
        return $this->task_usage_count;
    }

    function getTask_is_favorite() {
        return $this->task_is_favorite;
    }

    function setTask_id($task_id) {
        $this->task_id = $task_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setTask_file_name($task_file_name) {
        $this->task_file_name = $task_file_name;
    }

    function setTask_instruction($task_instruction) {
        $this->task_instruction = $task_instruction;
    }

    function setTask_image_small($task_image_small) {
        $this->task_image_small = $task_image_small;
    }

    function setTask_image_large($task_image_large) {
        $this->task_image_large = $task_image_large;
    }

    function setTask_date_create($task_date_create) {
        $this->task_date_create = $task_date_create;
    }

    function setTask_date_last_modify($task_date_last_modify) {
        $this->task_date_last_modify = $task_date_last_modify;
    }

    function setTask_date_last_use($task_date_last_use) {
        $this->task_date_last_use = $task_date_last_use;
    }

    function setTask_usage_count($task_usage_count) {
        $this->task_usage_count = $task_usage_count;
    }

    function setTask_is_favorite($task_is_favorite) {
        $this->task_is_favorite = $task_is_favorite;
    }

    public function getTaskHash(){
        return md5($this->task_instruction);
    }

    
    
}
