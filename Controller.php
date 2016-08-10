<?php

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
    
    public abstract function executeRequest($http_request);
}
