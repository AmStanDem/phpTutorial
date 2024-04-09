<?php
$hostname = 'localhost'; // The IP address of the db server.
$port = 3306;
$username = 'root'; // The username of the db server.
$password = ''; // The password of the user in the db server.
$database = 'tutorial-php'; // The name of the database to connect in the db server.
/*
 * The socket parameter in the context of MySQLi
 * refers to the transport layer used for establishing connections to a MySQL server.
 * When we specify an ipv4 for the hostname we render this parameter optional*/

// Two ways of connection with a database.

// 1. mysqli
// 2. PDO

// mysqli.
// First way is with the mysqli class, for connect to a MySQL db server.
$connect = new mysqli($hostname,$username,$password,$database, /*$port is optional*/); // I create an object that represents my connection with the MySQL db.
// Check for errors.

if ($connect->connect_errno) // Check if it is present an error in the connection with the db.
{
    die('DB connection error '.$connect->connect_error);
}

// PDO
// The second way is with the PDO class, for connect to different types of databases.
try
{
    // We have these parameters:
    // DSN: Data Source Name. It contains the type of db, the hostname and the database name.
    // The port is optional for a MySQL DSN.
    $db = new PDO ("mysql:host=$hostname;port=$port;dbname=$database", $username, $password,
        array(/*The options you want to insert with this syntax: */ PDO::ATTR_PERSISTENT => true));
}
catch (PDOException $e)
{
    die('DB connection error '.$e->getMessage());
}

