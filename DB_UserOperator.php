<?php

use DB_Connector;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB_UserOperator
 *
 * @author sergey
 */
class DB_UserOperator extends DB_Connector {
   
    
    public function getUserByEmail(string $user_email, &$db_error) {
        $sqlStatement = "SELECT `user_id`,`user_login`,`user_email`,`user_password`,`user_date_registration` FROM `user_registration_table` WHERE `user_email` = {USERMAIL}";
        str_replace("{USERMAIL}", $user_email, $sqlStatement);
        $result = $this->executeSQL($sql_statement, $db_error);
        $user = FALSE;
        if (($result) && (mysqli_affected_rows($result))) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["user_id"];
            $user_login = $row["user_login"];
            $user_email = $row["user_email"];
            $user_password = $row["user_password"];
            $user_date_registration = $row["user_date_registration"];
            $user = new DB_MobileUser($user_id, $user_login, $user_email, $user_password, $user_date_registration);
        } 
        $this->closeConnection();
        return $user;
        
    }
    
    public function getUserById(string $user_id, &$db_error){
        $sqlStatement = "SELECT `user_id`,`user_login`,`user_email`,`user_password`,`user_date_registration` FROM `user_registration_table` WHERE `user_id` = {USERID}";
        str_replace("{USERID}", $user_id, $sqlStatement);
        $result = $this->executeSQL($sql_statement, $db_error);
        $user = FALSE;
        if (($result) && (mysqli_affected_rows($result))) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["user_id"];
            $user_login = $row["user_login"];
            $user_email = $row["user_email"];
            $user_password = $row["user_password"];
            $user_date_registration = $row["user_date_registration"];
            $user = new DB_MobileUser($user_id, $user_login, $user_email, $user_password, $user_date_registration);
        } 
        $this->closeConnection();
        return $user;
    }
    
    public function deleteUserById(string $user_id, &$db_error){
       $sqlStatement = "DELETE FROM `user_registration_table` WHERE `user_id` = {USERID}";
       str_replace("{USERID}", $user_id, $sqlStatement);
       $db_result = $this->executeSQL($sqlStatement,$db_error);
       $result = ($db_result != FALSE);
       $this->closeConnection();
       return $result;
    }
    
    public function updateUser(DB_MobileUser $user, &$db_error){
        $sqlStatement = "UPDATE `user_registration_table` ".
                "SET `user_login` = {USER_LOGIN},".
                "`user_email` = {USER_EMAIL},".
                "`user_password` = {USER_PASSWORD}".
                "WHERE `user_id` = {USER_ID}";
        str_replace("{USER_LOGIN}", $user->getUser_login(), $sqlStatement);
        str_replace("{USER_EMAIL}", $user->getUser_email(), $sqlStatement);
        str_replace("{USER_PASSWORD}", $user->getUser_password(), $sqlStatement);
        str_replace("{USER_ID}", $user->getUser_id(), $sqlStatement);
        $db_result = $this->executeSQL($sql_statement, $db_error);
        $result = ($db_result != FALSE);
        $this->closeConnection();
        return $result;
        
    }

    public function createUser( string $user_login,string  $user_email,string $user_password, &$db_error){
        $sqlStatement = 'insert into `user_registration_table`(`user_login`,`user_email`,`user_password`,`user_date_registration`) '.
            'VALUES({USER_LOGIN},{USER_EMAIL},{USER_PASSWORD},{USER_DATE_REGISTRATION})';
        $current_data = date();
        $passwd = $user_password.$current_data;
        $passwd = sha1($passwd);
        str_replace("{USER_LOGIN}", $user_login, $sqlStatement);
        str_replace("{USER_EMAIL}", $user_email, $sqlStatement);
        str_replace("{USER_PASSWORD}", $passwd, $sqlStatement);
        str_replace("{USER_DATE_REGISTRATION}", $current_data, $sqlStatement);
        $db_result = $this->executeSQL($sql_statement, $db_error);
        $result = ($db_result != FALSE);
        $this->closeConnection();
        return $result;
    }

//put your code here
}
