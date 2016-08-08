<?php

use DB_Config;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB_Connector
 *
 * @author sergey
 */


class DB_Connector {
    
    protected  $mysqli_connection;

    protected function establisheMySqli_Connection(){
        $this->mysqli_connection = new mysqli(DB_Config::getServer_Name(), DB_Config::getDB_Username(), 
                DB_Config::getDB_Password(), DB_Config::getDB_Name()); ;   
    }
    
    
    
    protected function executeSQL($sql_statement, &$db_error){
        $result = false;
        $this->establisheMySqli_Connection();
        $mysqli = $this->mysqli_connection;
        if ($mysqli->connect_errno) {
            $db_error = $mysqli->connect_errno."-".$mysqli->connect_error();
            
        }else{
            $query_result = $mysqli->query($query);
            if(!$query_result){
                $db_error = $mysqli->errno."-".$mysqli->error;
                
            }
            else{
                $result = $query_result;
            }    
        }
        return $result;  
    }
    
    protected function executeInsertSQL($sql_statement, &$db_error){
        $insertedId = false;
        $this->establisheMySqli_Connection();
        $mysqli = $this->mysqli_connection;
        if (mysqli_connect_errno()) {
            $db_error = $mysqli->connect_errno."-".$mysqli->connect_error();
            
        }else{
            $query_result = $mysqli->query($query);
            if(!$query_result){
                $db_error = $mysqli->errno."-".$mysqli->error;
                
            }
            else{
                $insertedId = $mysqli->insert_id;
            }    
        }
        
        return $insertedId;    
    }

    protected function closeConnection(){
        $this->mysqli_connection->close();
    }
    
   
    
   
}
