<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayConvertable
 *
 * @author Radchuk
 */


class ArrayConvertable {
    //put your code here
    
    function __construct() {
        $reflector = new ReflectionClass($this);
        $properties = $reflector->getProperties();
        foreach ($properties as $property){
            $this->{$property->getName()} = FALSE;
        };
    }
    public function setAllFromArray($array){
        
        $reflector = new ReflectionClass($this);
        $properties = $reflector->getProperties();
        foreach ($properties as $property){
            $propName = $property->getName();
            //$propName = $this->{$property->getName()};
            if(isset($array[$propName])){
                $this->{$propName} = $array[$propName];
            }
        }
        
    }
    
    public function getCheckSum(){
        $str = '';
        foreach ($this as $key=>$value) {
            $str = $str.$value;
        }
        return sha1($str);
    }
}
