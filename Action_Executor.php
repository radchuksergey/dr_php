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
abstract class Action_Executor {
    public abstract function executeRequest($http_request);
}
