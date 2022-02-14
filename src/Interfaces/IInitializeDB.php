<?php

namespace App\Interfaces;

interface IInitializeDB
{
    /**
     * Initialize the chosen database in mysql using the credentials
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     * @return PDO Will return a Data Object (Database)
     */
    public function init($mysql_creds);

    /**
     * Create a users table with keys and values of unique id, username, password, and date created.
     * @param PDO $db The initialized database.
     * @param object $mysql_creds An array object that consist of keys and values of the users table in a database.
     */
    public function create_users_table($db, $mysql_creds);
}