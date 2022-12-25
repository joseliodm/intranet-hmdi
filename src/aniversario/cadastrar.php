<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['salario'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo função!</div>"];
} elseif (empty($dados['idade'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo dia!</div>"];
} else {
    $query_usuario = "INSERT INTO aniversariantes (nome, funcao, idade) VALUES (:nome, :funcao, :idade)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(":nome", $dados['nome'], PDO::PARAM_STR);
    $cad_usuario->bindParam(":funcao", $dados['salario'], PDO::PARAM_STR);
    $cad_usuario->bindParam(":idade", $dados['idade'], PDO::PARAM_STR);
    $cad_usuario->execute();


    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aniversariante cadastrado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aniversariante não cadastrado com sucesso!</div>"];
    }
}

echo json_encode($retorna);
