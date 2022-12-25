<?php
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
    $query_usuario = "DELETE FROM computadores WHERE id=:id";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(":id", $id, PDO::PARAM_INT);

    if($result_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> apagado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não apagado com sucesso!</div>"];
    }
}else{
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro:  não apagado com sucesso!</div>"];
}

echo json_encode($retorna);