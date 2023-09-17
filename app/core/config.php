<?php



if ($_SERVER['SERVER_NAME'] == "localhost") {

    // data base config
    define('DBNAME', "my_db");
    define('DBHOST', "localhost");
    define('DBUSER', "root");
    define('DBPASS', "");

    define('ROOT', "http://localhost/framework/public");
} else {
    //When i go to my website domain settings i can re-edit this settings
    define('DBNAME', "my_db");
    define('DBHOST', "localhost");
    define('DBUSER', "root");
    define('DBPASS', "");
    define('ROOT', "http://localhost/framework/public");
}

define("APP_NAME", "MY_Website");
define('APP_DESC', "My website");
