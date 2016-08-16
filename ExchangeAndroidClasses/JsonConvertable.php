<?php
namespace ExchangeAndroidClasses;

use ArrayConvertable;

require_once __DIR__.DIRECTORY_SEPARATOR.'ArrayConvertable.php';



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JsonConvertable
 *
 * @author Radchuk
 */
class JsonConvertable extends ArrayConvertable {
    //put your code here
    
    function __construct() {
        parent::__construct();
    }


    public function getObjectAsJson(){   
        return json_encode(get_object_vars($this));
    }
    
    public function setObjectFieldsFromJson( $json){
             
        $this->setAllFromArray(json_decode($json, TRUE));
    }
}
