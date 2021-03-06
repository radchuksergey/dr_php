<?php
namespace ExchangeAndroidClasses;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__.DIRECTORY_SEPARATOR.'Controller.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'TaskController.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'UserController.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'ExtremeController.php';


/**
 * Description of AndroidController
 *
 * @author Radchuk
 */
class AndroidController extends Controller {
    //put your code here
    public function executeRequest($http_request) {
        $controller = FALSE ;
        $result = FALSE;
        if (isset($http_request[self::ACTION])){
            $action = $http_request[self::ACTION];
            switch ($action){
                case self::REGISTER_ACTION:;  
                case self::LOGIN_ACTION: $controller =  new UserController(); break;
                case self::TASK:;
                case self::DELETE_TASK:;
                case self::CREATE_TASK:;
                case self::UPDATE_TASK:;
                case self::TASK_LIST; $controller = new TaskController();break;
                case self::REMOVE_ALL_ACTION: $controller = new ExtremeController();break;
         
            }
        }
        if($controller){
            $result = $controller->executeRequest($http_request);
            
        }
        echo $result;
        //print_r($result);
    }

}
	