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

function getAll($db)
{
    $sql = "SELECT * FROM equipos";
    $consulta = $db->prepare($sql);
    $consulta->execute();
    $resultado = $consulta->fetchAll();
    return $resultado;
}

function getFilteredData($db, $path)
{
    $sql = "SELECT * FROM equipos WHERE equipo LIKE ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array("%$path%"));
    $resultado = $consulta->fetchAll();
    return $resultado;
}

function editTeam($db, $data)
{
    $sql = "UPDATE equipos SET equipo = ? WHERE id = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($data['equipo'], $data['oldId']));
}


function getTeam($db, $id)
{
    $sql = "SELECT equipo FROM equipos WHERE id = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($id));
    $resultado = $consulta->fetchAll();
    return $resultado;
}

function deleteTeam($db, $id)
{
    $sql = "DELETE FROM equipos WHERE id = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($id));
}

function addTeam($db, $data)
{
    $sql = "INSERT INTO equipos (equipo) VALUES (\"".$data['equipo']."\")";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($data['equipo']));
    if ($consulta) {
        return true;
    }
    return false;
}

function getAuthorizedUsers($db){
    $sql = "SELECT * FROM usuarios WHERE perfil = 'admin'";
    $consulta = $db->prepare($sql);
    $consulta->execute();
    $resultado = $consulta->fetchAll();
    return $resultado;

}