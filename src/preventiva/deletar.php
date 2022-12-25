<?php
include_once "conexao.php";

// deletar varios registros de uma vez selecionados pelo checkbox
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $id = implode(',', $id);
    $query = "DELETE FROM computadores WHERE id IN ($id)";
    $result = $conn->prepare($query);
    $result->execute();
    header("Location: listar_usuarios.php");
}else{
    header("Location: index.php");
}
