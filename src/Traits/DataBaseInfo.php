<?php


namespace App\Traits;

trait DataBaseInfo{

    /**
     * Will display the active number of users in a database
     * @param PDO $db The initialized database.
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @return int The number of items in a talbe
     */
    public function show_number_of_queries($db, $mysql_creds)
    {
        $table_name = $mysql_creds->{'table_name'};
         try{
            $query = $db->query("SELECT * FROM $table_name");
            $result = $query->fetchAll(\PDO::FETCH_ASSOC);
            return count($result);
            
        } catch (\Error $e) {
            return 0;
            
        }
    }
}