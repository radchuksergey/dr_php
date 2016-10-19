<?php

namespace ExchangeAndroidClasses;
require_once __DIR__.DIRECTORY_SEPARATOR.'JsonConvertable.php';


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
class DB_UserTask extends \ExchangeAndroidClasses\JsonConvertable{
   
    /**
     * @var int
     */
    protected $task_id;
    /**
     * @var string
     */
    protected $task_type;
    /**
     * @var int
     */
    protected $user_id;
    /**
     * @var string
     */
    protected $task_file_name;
    /**
     * @var string
     */
    protected $task_instruction;
    /**
     * @var string
     */
    protected $task_image_small;
    /**
     * @var string
     */
    protected $task_image_large;
    /**
     * @var Date
     */
    protected $task_date_create;
    /**
     * @var Date
     */
    protected $task_date_last_modify;
    /**
     * @var Date
     */
    protected $task_date_last_use;
    /**
     * @var int
     */
    protected $task_usage_count;
    /**
     * @var string
     */
    protected $task_is_favorite;
    
    /**
     * @var string
     */
    protected $task_camera;
    
     /**
     * @var string
     */
    protected $task_uav_model;
    

    /**
     * @var string
     */
    protected $task_fly_time;

    /**
     * @var string
     */
    protected $task_fly_distance;

    /**
     * @var string
     */
    protected $task_status;
            
    /**
     * @var int
     */
    protected $marked_as_delete;
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @return int
     */
    function getMarked_as_delete(){
        return $this->marked_as_delete;
    }
    
    
    function getTask_camera() {
        return $this->task_camera;
    }

    function getTask_uav_model() {
        return $this->task_uav_model;
    }

    function getTask_fly_time() {
        return $this->task_fly_time;
    }

    function getTask_fly_distance() {
        return $this->task_fly_distance;
    }

    function getTask_status() {
        return $this->task_status;
    }

    function setTask_camera($task_camera) {
        $this->task_camera = $task_camera;
    }

    function setTask_uav_model($task_uav_model) {
        $this->task_uav_model = $task_uav_model;
    }

    function setTask_fly_time($task_fly_time) {
        $this->task_fly_time = $task_fly_time;
    }

    function setTask_fly_distance($task_fly_distance) {
        $this->task_fly_distance = $task_fly_distance;
    }

    function setTask_status($task_status) {
        $this->task_status = $task_status;
    }
    
    
    /**
     * 
     * @param int $marked_as_delete
     * @return void Description
     */
    
    function setMarked_as_delete($marked_as_delete){
        $this->marked_as_delete = $marked_as_delete;
    }
    
    
    /**
    * @return string
    */
    function getTask_type() {
        return $this->task_type;
    }
    /**
    * @param string $task_type
    * @return void
    */
    function setTask_type($task_type) {
        $this->task_type = $task_type;
    }
    
    /**
    * @return int
    */
    public function getTask_id() {
        return $this->task_id;
    }

    /**
    * @return int
    */
    public function getUser_id() {
        return $this->user_id;
    }
    
    /**
    * @return string
    */
    public function getTask_file_name() {
        return $this->task_file_name;
    }
    /**
    * @return string
    */
    public function getTask_instruction() {
        return $this->task_instruction;
    }
    /**
    * @return string
    */
    public function getTask_image_small() {
        return $this->task_image_small;
    }
    /**
    * @return string
    */
    public function getTask_image_large() {
        return $this->task_image_large;
    }
    /**
    * @return Date
    */
    public function getTask_date_create() {
        return $this->task_date_create;
    }
    
    /**
     * @return string task_date_create
     */
    public function getTask_date_create_AsString(){
        return date(self::DATE_FORMAT, $this->task_date_create);
    } 

    /**
    * @return Date
    */
    public function getTask_date_last_modify() {
        return $this->task_date_last_modify;
    }
    
    /**
     * @return string task_date_last_modify
     */
     public function getTask_date_last_modify_AsString() {
        //return $this->task_date_last_modify;
        return date(self::DATE_FORMAT, $this->getTask_date_last_modify());
    }
    
    /**
    * @return Date
    */
    public function getTask_date_last_use() {
        return $this->task_date_last_use;
    }
    
    /**
     * @return string Description
     */
    
    public function getTask_date_last_use_AsString() {
        //return $this->task_date_last_use;
        return date(self::DATE_FORMAT,$this->getTask_date_last_use());
    }
    
    /**
    * @return int
    */
    public function getTask_usage_count() {
        return $this->task_usage_count;
    }
    
    /**
    * @return string
    */
    public function getTask_is_favorite() {
        return $this->task_is_favorite;
    }

    /**
    * @param int $task_id
    * @return void
    */
    public function setTask_id($task_id) {
        $this->task_id = $task_id;
    }

    /**
    * @param int $user_id
    * @return void
    */
    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    /**
    * @param string $task_file_name
    * @return void
    */
    public function setTask_file_name($task_file_name) {
        $this->task_file_name = $task_file_name;
    }
    
    /**
    * @param string $task_instruction
    * @return void
    */
    public function setTask_instruction($task_instruction) {
        $this->task_instruction = $task_instruction;
    }
    
    /**
    * @param string $task_image_small
    * @return void
    */
    public function setTask_image_small($task_image_small) {
        $this->task_image_small = $task_image_small;
    }

    /**
    * @param string $task_image_large
    * @return void
    */
    public function setTask_image_large($task_image_large) {
        $this->task_image_large = $task_image_large;
    }
    
    /**
    * @param Date $task_date_create
    * @return void
    */
    public function setTask_date_create($task_date_create) {
        $this->task_date_create = $task_date_create;
    }
    
    /**
    * @param Date $task_date_last_modify
    * @return void
    */
    public function setTask_date_last_modify($task_date_last_modify) {
        $this->task_date_last_modify = $task_date_last_modify;
    }
    
    /**
    * @param Date $task_date_last_use
    * @return void
    */
    public function setTask_date_last_use($task_date_last_use) {
        $this->task_date_last_use = $task_date_last_use;
    }
    
    
    /**
    * @param int $task_usage_count
    * @return void
    */
    public function setTask_usage_count($task_usage_count) {
        $this->task_usage_count = $task_usage_count;
    }
    
    /**
    * @param string $task_is_favorite
    * @return void
    */
    public function setTask_is_favorite($task_is_favorite) {
        $this->task_is_favorite = $task_is_favorite;
    }

    /**
    * @return string
    */
    public function getTaskHash(){
        return md5($this->task_instruction);
    }

    
    
}
