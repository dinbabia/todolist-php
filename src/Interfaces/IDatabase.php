<?php

namespace App\Interfaces;

interface IDatabase
{
    

    /**
     * Add a new query in the database
     * @param PDO $db The initialized Database
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @param array $values An array that consists of values to be added in the table.
     * @return None
     */
    public function add($db, $mysql_creds, ...$values);

    /**
     * Get all data in the database. Will print per user array.
     * 
     * @param PDO $db The initialized database.
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @return object An array object that consist of keys and values of the selected table. 
     */
    public function read($db, $mysql_creds);

    /**
     * Changes the data inside the database depending on the payload used.
     * @param PDO $db The initialized database.
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @param string $find_table_column One of the key in key-value array of the user to be updated.
     * @param string $set_value The value of the key chosen in key-value array of the user to be updated.
     * @param string $edit_table_column The key name of one of the set-keys of the array object, and selecting its value which will be then changed from $where_value to $set_value.
     * @param string $where_value The value of the key to be changed. This is the data that will change the previous value.
     * @return None
     */
    public function update($db, $mysql_creds, string $find_table_column, string $set_value, string $edit_table_column, string $where_value);

    /**
     * Delete a user inside the database
     * @param PDO $db The initialized database.
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @param string $key One of the key in key-value array of the user to be deleted.
     * @param string $value The value of the key to be deleted.
     * @return None
     */
    public function delete($db, $mysql_creds,string $key,string $value);


    /**
     * Delete all data in database
     * @param PDO $db The initialized database.
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @return None
     */
    public function deleteAll($db, $mysql_creds);
}