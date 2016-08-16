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
    
    const ANSWER = 'answer';
    const CREATED = 'created';
    const DELETED = 'deleted';
    const UPDATED = 'updated';
    const TASKLIST = 'tasklist';
    
    const ERRORS = 'errors';

    public abstract function executeRequest($http_request);
}