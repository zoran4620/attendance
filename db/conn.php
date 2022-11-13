<?php    
    $host = 'sql6.freesqldatabase.com';
    $db = '	sql6528858';
    $user = 'sql6528858';
    $pass = '47zLl8me73';
    $charset = 'utf8mb4';
    //$host = 'localhost';
    //$db = 'attendee_db';
    //$user = 'root';
    //$pass = 'Kr1234**';
    //$charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try{
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }

    require_once 'crud.php';
    require_once 'user.php';
    $crud = new crud($pdo);
    $user = new user($pdo);
   
    $user->insertUser("admin","password");
?>