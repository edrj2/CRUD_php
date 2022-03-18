<?php

include_once './conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
var_dump($id);

if(empty($id)){
    header("Location:index.php");
    exit();
}

$query_usuario = "SELECT id FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();
if(($result_usuario) AND ($result_usuario->rowCount()!=0)){
    $query_del_usuario = "DELETE FROM usuarios WHERE id=$id";
    $apagar_usuario = $conn->prepare($query_del_usuario);
    $apagar_usuario->execute();
    header("Location:index.php");
    
}
else{
    header("Location:index.php");
    exit();
}