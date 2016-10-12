<?php
namespace ExchangeAndroidClasses;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Action_Executor
 *
 * @author sergey
 */



abstract class Controller {
    const ACTION = 'action';
    const USER = 'user';
    const TASK = 'task';
    
    
    const LOGIN_ACTION = 'login';
    const REGISTER_ACTION = 'register';
    const REMOVE_ALL_ACTION = 'removeall';
    
    
    const CREATE_TASK = 'create_task';
    const TASK_LIST = 'task_list';
    const TASK_LIST_EMPTY = 'task_list_empty';
    const UPDATE_TASK = 'update_task';
    const DELETE_TASK = 'delete_task';
    
    const ANSWER = 'answer';
    const CREATED = 'created';
    const DELETED = 'deleted';
    const UPDATED = 'updated';
    const TASKLIST = 'tasklist';
    
    const ERRORS = 'errors';
    const ERROR_USER_EXIST = 'user already exist';
    const ERROR_PASSWORD_USER_INCORRECT = 'login or password incorrect';
    
   

    public abstract function executeRequest($http_request);
}
