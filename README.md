# todolist-php

### Requirements in using this project:
1. php installed on your machine (prefereablly version 7.4)
2. MySQL
3. Composer
4. IDE, preferably Visual Studio Code

How to use:
1. After cloning to your machine, go to the main folder ('todolist-php'), then run the code below in the terminal.
   * composer dump-autoload   
   * //This will activate the composer and make a folder named 'vendor' in your main folder.
2. Go to 'mysql_creds.json' in the main folder and input your credentials for your MySql.
3. You're all good to go. Just go to your terminal inside your main folder of this repo and run the code below:
   * php -S localhost:8000  
   * //This will look for your 'index.php' file in this project and run it your localhost in port 8000. Just open your browser and type ('localhost:8000') 
   * //This will also automatically create a database named 'todolist_php' and tables 'user' and 'tasks'.
