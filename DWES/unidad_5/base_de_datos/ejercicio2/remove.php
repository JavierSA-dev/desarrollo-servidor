<?php
include_once('config/config.php');
include_once('lib/functions.php');

session_start();
$db = conectaDB();

if ($_SESSION['profile'] != 'admin') {
    header('Location: index.php');
} else {
    deleteTeam($db, $_GET['id']);
    header("Location: index.php");
}
