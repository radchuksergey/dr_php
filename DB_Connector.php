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
    
    protected $db_Connection;

    protected function createDB_Connection(&$db_error){
        $connection = mysqli_connect(DB_Config::getServer_Name(), DB_Config::getDB_Username(),DB_Config::getDB_Password(), DB_Config::getDB_Name());
        if(!$connection){
            $db_error = mysqli_connect_errno()."-".mysqli_connect_error();
        }
        $this->db_Connection = $connection;
    }
    
    protected function executeSQL($sql_statement, &$db_error){
        $connection_error = "";
        if (!$this->db_Connection){
            createDB_Connection($connection_error);
        }
        if(!$$this->db_Connection){
            $db_error = $connection_error;
            return FALSE;
        }
        $result = mysqli_query($this->db_Connection, $sql_statement);
        if(!$result){
            $db_error = mysqli_errno($connection);
        }
        return $result;
        
    }
    
    protected function closeConnection(){
        mysqli_close($this->db_Connection);
    }
    
   
    
   
}
