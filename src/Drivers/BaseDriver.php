<?php

namespace App\Drivers;

use App\Interfaces\IDatabase;



/**
 * The Parent Class of SqLite and MySql
 * 
 */
class BaseDriver implements IDatabase
{

    

    /**
     *@inheritdoc
     */
    public function add($db, $mysql_creds, ...$values)
    {
        $table_name = $mysql_creds->{'table_name'};
        
        if ($table_name == 'users')
        {
            $username = $mysql_creds->{'username'};
            $password = $mysql_creds->{'password'};
            $created_at = $mysql_creds->{'created_at'};
            $db->exec("INSERT INTO $table_name($username, $password, $created_at) VALUES('$values[0]','$values[1]', now())");
        }
        if ($table_name == "tasks")
        {
            $task_name = $mysql_creds->{'task_name'};
            $created_at = $mysql_creds->{'created_at'};
            $db->exec("INSERT INTO $table_name($task_name, $created_at) VALUES('$values[0]', now())");
        }
        
        
        
    }

    /**
     *@inheritdoc
     */
    public function read($db, $mysql_creds)
    {   
        $table_name = $mysql_creds->{'table_name'};
        try{
            $query = $db->query("SELECT * FROM $table_name");
            $result = $query->fetchAll(\PDO::FETCH_ASSOC);
            
            return $result;

        } catch (\Error $e) {
            
            return $e;
        }
        
    }

    /**
     *@inheritdoc
     */
    public function update($db, $mysql_creds, $find_table_column, $set_value, $edit_table_column, $where_value)
    {
        $table_name = $mysql_creds->{'table_name'};
        $find_column_name = $mysql_creds->{$find_table_column};
        $edit_column_name = $mysql_creds->{$edit_table_column};
        try{
            $db->exec("UPDATE $table_name SET $edit_column_name='$where_value' WHERE $find_column_name='$set_value'");
            
            
        } catch (\Error $e) {
            return $e;
            
        }
    }

    /**
     *@inheritdoc
     */
    public function delete($db, $mysql_creds, $key, $value)
    {
        $table_name = $mysql_creds->{'table_name'};
        try{
            $db->exec("DELETE FROM $table_name WHERE $key='$value'");
            
            
        } catch (\Error $e) {
            return $e;  
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteAll($db, $mysql_creds)
    {
        $table_name = $mysql_creds->{'table_name'};
        try{
            $db->exec("DELETE FROM $table_name");
            
        } catch (\Error $e) {
            return $e;  
        }
    }
}