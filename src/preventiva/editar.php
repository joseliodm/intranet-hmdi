<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['patrimonio'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo patrimônio!</div>"];
} elseif (empty($dados['descricao'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Modelo!</div>"];
} elseif (empty($dados['custo'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo custo!</div>"];    
}
elseif (empty($dados['local_'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo local!</div>"];
}
elseif (empty($dados['data_prev'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo data prevista!</div>"];
} 
elseif (empty($dados['data_prox'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Proxima data!</div>"];
}
elseif (empty($dados['observacao'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo observação!</div>"];
}
elseif (empty($dados['tecnico'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo tecnico!</div>"];
}
else {
    //Criar funcao para editar no banco de dados os seguintes campos id, andar, monitor, hostName_Antigo, hostName_Novo, login, sistema_Operacional, perifericos, office, patrimonio, descricao, custo, local_, data_prev, data_prox, observacao, tecnico
    $query = "UPDATE computadores SET andar = :andar, monitor = :monitor, hostName_Antigo = :hostName_Antigo, hostName_Novo = :hostName_Novo, login = :login, sistema_Operacional = :sistema_Operacional, perifericos = :perifericos, office = :office, patrimonio = :patrimonio, descricao = :descricao, custo = :custo, local_ = :local_, data_prev = :data_prev, data_prox = :data_prox, observacao = :observacao, tecnico = :tecnico WHERE id = :id";
    $update = $conn->prepare($query);
    $update->bindParam(':id', $dados['id']);
    $update->bindParam(':andar', $dados['andar']);
    $update->bindParam(':monitor', $dados['monitor']);
    $update->bindParam(':hostName_Antigo', $dados['hostName_Antigo']);
    $update->bindParam(':hostName_Novo', $dados['hostName_Novo']);
    $update->bindParam(':login', $dados['login']);
    $update->bindParam(':sistema_Operacional', $dados['sistema_Operacional']);
    $update->bindParam(':perifericos', $dados['perifericos']);
    $update->bindParam(':office', $dados['office']);
    $update->bindParam(':patrimonio', $dados['patrimonio']);
    $update->bindParam(':descricao', $dados['descricao']);
    $update->bindParam(':custo', $dados['custo']);
    $update->bindParam(':local_', $dados['local_']);
    $update->bindParam(':data_prev', $dados['data_prev']);
    $update->bindParam(':data_prox', $dados['data_prox']);
    $update->bindParam(':observacao', $dados['observacao']);
    $update->bindParam(':tecnico', $dados['tecnico']);
    $update->execute();
    if ($update->rowCount()) {
        $retorna = ['status' => true, 'msg' => "Cadastrado com sucesso!"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Campos não editados</div>"];
    }

}

echo json_encode($retorna);