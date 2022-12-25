<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//condição para verificar se existe patrimonio cadastrado no banco de dados para não cadastrar um novo patrimonio com o mesmo nome
$query_patrimonio = "SELECT patrimonio FROM computadores WHERE patrimonio = :patrimonio";
$result_patrimonio = $conn->prepare($query_patrimonio);
$result_patrimonio->bindParam(':patrimonio', $dados['patrimonio']);
$result_patrimonio->execute();
$query_monitor = "SELECT monitor FROM computadores WHERE monitor = :monitor";
$result_monitor = $conn->prepare($query_monitor);
$result_monitor->bindParam(':monitor', $dados['monitor']);
$result_monitor->execute();
if (($result_patrimonio) and ($result_patrimonio->rowCount() != 0)) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Número de Patrimonio ja cadastrado!</div>"];

} elseif (($result_monitor) and ($result_monitor->rowCount() != 0)) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Número de Patrimonio do Monitor ja cadastrado!</div>"];
}
else {
    $query_usuario = "INSERT INTO computadores (id, andar, monitor, hostName_Antigo, descricao, hostName_Novo, login, sistema_Operacional, perifericos, office, patrimonio, custo, local_, data_prev, data_prox, observacao, tecnico) VALUES (null, :andar, :monitor, :hostName_Antigo, :descricao, :hostName_Novo, :login,  :sistema_Operacional, :perifericos, :office, :patrimonio, :custo, :local_, :data_prev, :data_prox, :observacao, :tecnico)";
    $cad_usuario =$conn->prepare($query_usuario);
    $cad_usuario->bindParam(':andar', $dados['andar']);
    $cad_usuario->bindParam(':monitor', $dados['monitor']);
    $cad_usuario->bindParam(':hostName_Antigo', $dados['hostName_Antigo']);
    $cad_usuario->bindParam(':hostName_Novo', $dados['hostName_Novo']);
    $cad_usuario->bindParam(':login', $dados['login']);
    $cad_usuario->bindParam(':descricao', $dados['descricao']);
    $cad_usuario->bindParam(':sistema_Operacional', $dados['sistema_Operacional']);
    $cad_usuario->bindParam(':perifericos', $dados['perifericos']);
    $cad_usuario->bindParam(':office', $dados['office']);
    $cad_usuario->bindParam(':patrimonio', $dados['patrimonio']);
    $cad_usuario->bindParam(':custo', $dados['custo']);
    $cad_usuario->bindParam(':local_', $dados['local_']);
    $cad_usuario->bindParam(':data_prev', $dados['data_prev']);
    $cad_usuario->bindParam(':data_prox', $dados['data_prox']);
    $cad_usuario->bindParam(':observacao', $dados['observacao']);
    $cad_usuario->bindParam(':tecnico', $dados['tecnico']);
    $cad_usuario->execute();

    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> cadastrado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);