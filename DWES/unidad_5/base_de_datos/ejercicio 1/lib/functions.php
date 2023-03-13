<?php
function conectaDB()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD);
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        return ($db);
    } catch (PDOException $e) {
        echo "Error conexión";
        exit();
    }
}
