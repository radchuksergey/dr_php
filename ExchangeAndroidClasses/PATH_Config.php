<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PATH_Config
 *
 * @author Radchuk
 */
 class PATH_Config {
    public static function root_path(){
        return filter_input(INPUT_SERVER, 'DocumentRoot');
    }
    
    public static function classes_path(){
        return self::root_path().DIRECTORY_SEPARATOR.'Classes';
    }
    
    public static function controlers_path(){
        return self::classes_path().DIRECTORY_SEPARATOR.'Controllers';
    }
    
    public static function db_entityies_path(){
        return self::classes_path().DIRECTORY_SEPARATOR."DB_Entityes";
    }
    
    public static function db_layer_path(){
        return self::classes_path().DIRECTORY_SEPARATOR.'DB_Layer';
    }
}
