<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MobileUser
 *
 * @author sergey
 */
class DB_MobileUser {
    //put your code here
    //user_id`,`user_login`,`user_email`,`user_password`,`user_date_registration`
    private $user_id;
    private $user_login;
    private $user_email;
    private $user_password;
    private $user_date_registration;
    
    function __construct($user_id,$user_login,$user_email,$user_password,$user_date_registration) {
        $this->user_id = $user_id;
        $this->user_login = $user_login;
        $this->user_email = $user_email;
        $this->user_date_registration = $user_date_registration;
    }
    

            
    function getUser_id() {
        return $this->user_id;
    }

    function getUser_login() {
        return $this->user_login;
    }

    function getUser_email() {
        return $this->user_email;
    }

    function getUser_password() {
        return $this->user_password;
    }

    function getUser_date_registration() {
        return $this->user_date_registration;
    }

    public function isPaswordCorrect($password){
        $pass_str = $password.$this->user_date_registration;
        $pass_str = sha1($pass_str);
        return $this->user_password = $pass_str;     
    }
}

function setUser_id($user_id) {
    $this->user_id = $user_id;
}

 function setUser_login($user_login) {
    $this->user_login = $user_login;
}

 function setUser_email($user_email) {
    $this->user_email = $user_email;
}

 function setUser_password($user_password) {
    $this->user_password = $user_password;
}

 function setUser_date_registration($user_date_registration) {
    $this->user_date_registration = $user_date_registration;
}


