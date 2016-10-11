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
    const DATE_FORMAT = 'Y-m-d H:i:s';




    function __construct() {
        $reflector = new ReflectionClass($this);
        $properties = $reflector->getProperties();
        foreach ($properties as $property){
            $this->{$property->getName()} = FALSE;
        };
    }
    
    /*
     * @method
     * @param string $annotation 
     * @return string
     */
    private function decodeAnnotation($annotation){
        $result = $annotation;
        $result = str_replace("/", "", $result);
        $result = str_replace("*", "", $result);
        $result = preg_replace( '/[^[:print:]]/', '',$result);
        $result = trim($result);
        $result = explode(" ", $result);
        return $result[count($result) - 1];   
    }


    public function setAllFromArray($array){
        
        $reflector = new ReflectionClass($this);
        
        $properties = $reflector->getProperties();
        foreach ($properties as $property){
            $propName = $property->getName();
            $annotation = $property->getDocComment();
            $typename = $this->decodeAnnotation($annotation);
            if($typename == "int"){
                 if(isset($array[$propName])){
                    $this->{$propName} = intval($array[$propName]);
                }    
            }
            else if ($typename == "Date"){
                $this->{$propName} = strtotime($array[$propName]);
            }
            else{
                if(isset($array[$propName])){
                    $this->{$propName} = $array[$propName];
                }
            }
            //$propName = $this->{$property->getName()};
          
        }
        
    }
    
    /**
     * @return array $result
     */
    public function getAllAsStringArray(){
        $reflector = new ReflectionClass($this);
        $result = $this->getAsArray();
        $properties = $reflector->getProperties();
        foreach ($properties as $property){
            
            $propName = $property->getName();
            $annotation = $property->getDocComment();
            $typename = $this->decodeAnnotation($annotation);
           
            if($typename == "int"){
                 $result[$propName] = strval($result[$propName]);
            }
            else if ($typename == "Date"){
                $result[$propName] = date(self::DATE_FORMAT,$result[$propName]);
            }

        }
        return $result;
        
    }
    
    public function getCheckSum(){
        $str = '';
        foreach ($this as $key=>$value) {
            $str = $str.$value;
        }
        return sha1($str);
    }
    
    public function getAsArray(){
        
        foreach ($this as $key=>$value){
            $result[$key] = $value;
        }
        return $result;
    }
}
