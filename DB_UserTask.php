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
    private $task_type;
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
    function getTask_type() {
        return $this->task_type;
    }

    function setTask_type($task_type) {
        $this->task_type = $task_type;
    }

        public function getTask_id() {
        return $this->task_id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getTask_file_name() {
        return $this->task_file_name;
    }

    public function getTask_instruction() {
        return $this->task_instruction;
    }

    public function getTask_image_small() {
        return $this->task_image_small;
    }

    public function getTask_image_large() {
        return $this->task_image_large;
    }

    public function getTask_date_create() {
        return $this->task_date_create;
    }

    public function getTask_date_last_modify() {
        return $this->task_date_last_modify;
    }

    public function getTask_date_last_use() {
        return $this->task_date_last_use;
    }

    public function getTask_usage_count() {
        return $this->task_usage_count;
    }

    public function getTask_is_favorite() {
        return $this->task_is_favorite;
    }

    public function setTask_id($task_id) {
        $this->task_id = $task_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setTask_file_name($task_file_name) {
        $this->task_file_name = $task_file_name;
    }

    public function setTask_instruction($task_instruction) {
        $this->task_instruction = $task_instruction;
    }

    public function setTask_image_small($task_image_small) {
        $this->task_image_small = $task_image_small;
    }

    public function setTask_image_large($task_image_large) {
        $this->task_image_large = $task_image_large;
    }

    public function setTask_date_create($task_date_create) {
        $this->task_date_create = $task_date_create;
    }

    public function setTask_date_last_modify($task_date_last_modify) {
        $this->task_date_last_modify = $task_date_last_modify;
    }

    public function setTask_date_last_use($task_date_last_use) {
        $this->task_date_last_use = $task_date_last_use;
    }

    public function setTask_usage_count($task_usage_count) {
        $this->task_usage_count = $task_usage_count;
    }

    public function setTask_is_favorite($task_is_favorite) {
        $this->task_is_favorite = $task_is_favorite;
    }

     public function getTaskHash(){
        return md5($this->task_instruction);
    }

    
    
}
