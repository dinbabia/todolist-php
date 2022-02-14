<!DOCTYPE html>
<html>
    <head>
        <title> To Do List Assignment</title>

        <style>

            input[type=checkbox]:checked + label.strikethrough{
                text-decoration: line-through;
                }
            table, td, th {
                border: 2px solid black;
                border-color: darkblue;
                border-collapse: collapse;
                background-color: skyblue;
            }
            .submt-btn {
                background-color: green;
            }
            .delt-btn {
                background-color: orange;
            }
            

        </style>

    </head>
        <body>

        <?php
            
            require 'vendor/autoload.php';

            use App\Drivers\MYSQL;

            $mysql_creds = file_get_contents("mysql_creds.json");
            $mysql_creds = json_decode($mysql_creds);

            $mysql = new MYSQL;
            $database = $mysql->init($mysql_creds);
            $mysql->create_users_table($database, $mysql_creds);
            $mysql->create_tasks_table($database, $mysql_creds);
            
//---------------FORM Below---------------------
            

            echo "<form action='/index.php' method='post'>";
            echo "Task Name: <input type='text' name='task' required><br>";
            echo "<input type='submit' value='Add Task' name='submit-btn' class='submt-btn'>";
            echo "</form>";
            
                
            if (!empty($_POST)){
                $mysql->add($database, $mysql_creds->{"tasks_table"}, $_POST["task"]);  
                header('Location: '.'/');
            }

       
//---------------HTML Table Below---------------------

            echo "<table width='40%'>";

            echo "<tr>";
            echo "<th colspan='2'><b>|-----TO DO LIST-----|</b></th>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<th colspan='2'>";
            echo "You have {$mysql->show_number_of_queries($database, $mysql_creds->{"tasks_table"})} tasks today.";
            echo "</th>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td><center>";
            echo "Task Name";
            echo "</td>";
            echo "<td><center>";
            echo "Date Task Created";
            echo "</td>";
            echo "</tr>";

            $data = $mysql->read($database, $mysql_creds->{"tasks_table"});
            // print_r($data);
            foreach($data as $array)
            {
                echo "<tr>";

                    echo "<td width='70%'>";
                
                    
                    echo "<div>";
                    echo  "<input type='checkbox' name='task_checkbox_name' id='task_checkbox' value='1'/>";
                    echo  "<label for='task_checkbox' class='strikethrough'>{$array['task_name']}</label>";
    
                    echo "</div>";


                    echo "</td>";

                    echo "<td>";         
                    echo "<div>";
                    echo  "<label for='task_checkbox' class='strikethrough'>{$array['created_at']}</label>";
                    echo "</div>";
                    echo "</td>";

                echo "</tr>";
            }
            
            echo "</table>";
           
            //-----Delete Button Form-----
            echo "<form action='/index.php' method='get'>";
            echo "<input type='submit' value='Delete All Tasks' name='del-btn' class='delt-btn'>";
            echo "</form>";

            if (isset($_GET['del-btn'])) {
                $mysql->deleteAll($database, $mysql_creds->{"tasks_table"});  
                //redirect to homepage
                header('Location: '.'/');   
            }

            ?>
        </body>
    
    

</html>






