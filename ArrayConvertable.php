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
    public function setAllFromArray(array $array){
        foreach ($this as $key=>$value){
            if(isset($array[$key])){
                $value = $array[$key];
            }
        }
    }
}
