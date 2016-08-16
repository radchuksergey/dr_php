<?php
namespace ExchangeAndroidClasses;
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_Connector.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'DB_MobileUser.php';




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
class DB_UserOperator extends \ExchangeAndroidClasses\DB_Connector {
   
    
    public function getUserByEmail(string $user_email, &$db_error) {
        $sqlStatement = "SELECT `user_id`,`user_login`,`user_email`,`user_password`,`user_date_registration` FROM `user_registration_table` WHERE `user_email` = {USERMAIL}";
        str_replace("{USERMAIL}", $user_email, $sqlStatement);
        $result = $this->executeSQL($sql_statement, $db_error);
        $user = new DB_MobileUser;
        if (($result) && (mysqli_affected_rows($result))) {
            $row = mysqli_fetch_assoc($result);
            $user->setAllFromArray($row);
        } 
        $this->closeConnection();
        return $user;
        
    }
    
    public function getUserById(string $user_id, &$db_error){
        $sqlStatement = "SELECT `user_id`,`user_login`,`user_email`,`user_password`,`user_date_registration` FROM `user_registration_table` WHERE `user_id` = {USERID}";
        str_replace("{USERID}", $user_id, $sqlStatement);
        $result = $this->executeSQL($sql_statement, $db_error);
        $user = new DB_MobileUser();;
        if (($result) && (mysqli_affected_rows($result))) {
            $row = mysqli_fetch_assoc($result);
            $user->setAllFromArray($row);    
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

    public function createUser(DB_MobileUser &$user, &$db_error){
        $sqlStatement = 'insert into `user_registration_table`(`user_login`,`user_email`,`user_password`,`user_date_registration`) '.
            'VALUES({USER_LOGIN},{USER_EMAIL},{USER_PASSWORD},{USER_DATE_REGISTRATION})';
        $user->setUser_date_registration(date());
        $user->setUser_password(sha1($user->getUser_password().$user->getUser_date_registration()));
        str_replace("{USER_LOGIN}", $user->getUser_login(), $sqlStatement);
        str_replace("{USER_EMAIL}", $user->getUser_email(), $sqlStatement);
        str_replace("{USER_PASSWORD}", $user->getUser_password(), $sqlStatement);
        str_replace("{USER_DATE_REGISTRATION}", $user->getUser_date_registration(), $sqlStatement);
        $insert_result = $this->executeInsertSQL($sql_statement, $db_error);
        if($insert_result){
            $user->setUser_id($insert_result);
        }
        $this->closeConnection();
        return ($insert_result != FALSE);
    }
}
    
    


