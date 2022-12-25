<?php

include_once 'conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    
    $query_usuario = "SELECT id, andar, monitor, hostName_Antigo, hostName_Novo, descricao, login, sistema_Operacional, perifericos, office, patrimonio, custo, local_, data_prev, data_prox, observacao, tecnico FROM computadores WHERE id=:id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id', $id);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $retorna = ['status' => true, 'dados' => $row_usuario];
    }
    else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum computador encontrado!</div>"];
    }
}

echo json_encode($retorna);