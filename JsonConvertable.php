<?php

use ArrayConvertable;

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
    public function getObjectAsJson(){
        $json = get_object_vars($this);
        $json = json_encode($json);
        return $json;    
    }
    
    public function setObjectFieldsFromJson(string $json){
        $json_array = json_decode($json);
        $this->setAllFromArray($json_array);
    }
}
