<?php
use Dotenv\Dotenv;
require_once __DIR__ . '/../vendor/autoload.php';

/*DOTENV: A .env file is a file that contains sensitive data
for configuration(API credentials,db credentials etc.)
that we want to keep it secret.
In this case i use the .ENV file for memorize the credentials for my mysql database.
These credentials are relative to my machine, so they must be protected from other users.
In general, we add the .env file in the gitignore, in order to block any changes of it and any sharing of it.*/
/*If you want to use .env you can follow this tutorial: https://www.dotenv.org/docs/quickstart.
The step you need to do*/
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$hostname = $_ENV['HOSTNAME']; // The IP address of the db server.
$port = $_ENV['PORT'];
$username = $_ENV['USERNAME']; // The username of the db server.
$password = $_ENV['PASSWORD']; // The password of the user in the db server.
$database = $_ENV['DATABASE']; // The name of the database to connect in the db server.
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