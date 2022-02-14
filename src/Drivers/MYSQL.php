<?php


namespace App\Drivers;

use App\Interfaces\IInitializeDB;
use App\Traits\DataBaseInfo;

/**
 * This class will use all methods from ParentDatabase that implements from IDatabase Interface.
 * It has also a trait namely DatabaseInfo.
 */
class MYSQL extends BaseDriver implements IInitializeDB
{
    use DataBaseInfo;

    /**
     *@inheritdoc
     */
    public function init($mysql_creds)
    {   
        $creds = $mysql_creds->{'creds'};

        
        $host = $creds->{'host'};
        $root = $creds->{'root'};
        $root_password = $creds->{'root_password'};
        $user = $creds->{'user'};
        $pass = $creds->{'user_pass'};
        $db_name = $creds->{'database_name'};

        try {
            $dbh = new \PDO("mysql:host=$host", $root, $root_password);

            $dbh->exec("CREATE DATABASE `$db_name`;
                    CREATE USER '$user'@'$host' IDENTIFIED BY '$pass';
                    GRANT ALL ON `$db_name`.* TO '$user'@'$host';
                    FLUSH PRIVILEGES;");
                    
                    
            $conn = new \PDO("mysql:host=$host;dbname=$db_name", $root, '');
            return $conn;
        }        
        catch (\PDOException $e) {
            return $e;
        }
       

    }

    /**
     * @inheritdoc
     */
    public function create_users_table($db, $mysql_creds)
    {
        
        $creds = $mysql_creds->{'users_table'};
        $table_name = $creds->{'table_name'};
        $username = $creds->{'username'};
        $password = $creds->{'password'};
        $created_at = $creds->{'created_at'};
        
        $db->exec("CREATE TABLE $table_name(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            $username VARCHAR(30) NOT NULL,
            $password VARCHAR(30) NOT NULL,
            $created_at DATETIME)");    
    }

    /**
     * @inheritdoc
     */
    public function create_tasks_table($db, $mysql_creds)
    {
        
        $creds = $mysql_creds->{'tasks_table'};
        $table_name = $creds->{'table_name'};
        $task_name = $creds->{'task_name'};
        $created_at = $creds->{'created_at'};
        
        $db->exec("CREATE TABLE $table_name(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            $task_name VARCHAR(30) NOT NULL,
            $created_at DATETIME)");    
    }
}