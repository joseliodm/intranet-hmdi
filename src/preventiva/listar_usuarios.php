<?php

// Incluir a conexao com o banco de dados

include_once './conexao.php';


//Receber os dados da requisão

$dados_requisicao = $_REQUEST;

// Lista de colunas da tabela
$colunas = [
    0 => 'id',
    1 => 'andar',
    2 => 'monitor',
    3 => 'hostName_Antigo',
    4 => 'hostName_Novo',
    5 => 'login',
    6 => 'sistema_Operacional',
    7 => 'perifericos',
    8 => 'office',
    9 => 'patrimonio',
    10 => 'descricao',
    11 => 'local_',
    12 => 'data_prev',
    13 => 'data_prox',
    14 => 'observacao',
    15 => 'tecnico'
   
];


$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM computadores";

// Acessa o IF quando ha paramentros de pesquisa   

if(!empty($dados_requisicao['search']['value'])) {
    $query_qnt_usuarios .= " WHERE id LIKE :id ";
    $query_qnt_usuarios .= " OR andar LIKE :andar ";
    $query_qnt_usuarios .= " OR monitor LIKE :monitor ";
    $query_qnt_usuarios .= " OR hostName_Antigo LIKE :hostName_Antigo ";
    $query_qnt_usuarios .= " OR hostName_Novo LIKE :hostName_Novo ";
    $query_qnt_usuarios .= " OR login LIKE :login ";
    $query_qnt_usuarios .= " OR sistema_Operacional LIKE :sistema_Operacional ";
    $query_qnt_usuarios .= " OR perifericos LIKE :perifericos ";
    $query_qnt_usuarios .= " OR office LIKE :office ";
    $query_qnt_usuarios .= " OR patrimonio LIKE :patrimonio ";
    $query_qnt_usuarios .= " OR descricao LIKE :descricao ";
    $query_qnt_usuarios .= " OR local_ LIKE :local_ ";
    $query_qnt_usuarios .= " OR data_prev LIKE :data_prev ";
    $query_qnt_usuarios .= " OR data_prox LIKE :data_prox ";
    $query_qnt_usuarios .= " OR observacao LIKE :observacao ";
    $query_qnt_usuarios .= " OR tecnico LIKE :tecnico ";
 
}
// Preparar a QUERY

$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);

// Acessa o IF quando ha paramentros de pesquisa   

if(!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':andar', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':monitor', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':hostName_Antigo', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':hostName_Novo', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':login', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':sistema_Operacional', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':perifericos', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':office', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':patrimonio', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':descricao', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':local_', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':data_prev', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':data_prox', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':observacao', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':tecnico', $valor_pesq, PDO::PARAM_STR);
}
// Executar a QUERY responsável em retornar a quantidade de registros no banco de dados

$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

//var_dump($row_qnt_usuarios);

// Recuperar os registros do banco de dados

$query_usuarios = "SELECT id, andar, monitor, hostName_Antigo, hostName_Novo, login, sistema_Operacional, perifericos, office, patrimonio, descricao, custo, local_, data_prev, data_prox, observacao, tecnico FROM computadores";              

// Acessa o IF quando ha paramentros de pesquisa   

if(!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $query_usuarios .= " WHERE id LIKE :id ";
    $query_usuarios .= " OR andar LIKE :andar ";
    $query_usuarios .= " OR monitor LIKE :monitor ";
    $query_usuarios .= " OR hostName_Antigo LIKE :hostName_Antigo ";
    $query_usuarios .= " OR hostName_Novo LIKE :hostName_Novo ";
    $query_usuarios .= " OR login LIKE :login ";
    $query_usuarios .= " OR sistema_Operacional LIKE :sistema_Operacional ";
    $query_usuarios .= " OR perifericos LIKE :perifericos ";
    $query_usuarios .= " OR office LIKE :office ";
    $query_usuarios .= " OR patrimonio LIKE :patrimonio ";
    $query_usuarios .= " OR descricao LIKE :descricao ";
    $query_usuarios .= " OR local_ LIKE :local_ ";
    $query_usuarios .= " OR data_prev LIKE :data_prev ";
    $query_usuarios .= " OR data_prox LIKE :data_prox ";
    $query_usuarios .= " OR observacao LIKE :observacao ";
    $query_usuarios .= " OR tecnico LIKE :tecnico ";
}

// Ordenar os registros

$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio , :quantidade";

// Preparar a QUERY

$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

// Acessa o IF quando ha paramentros de pesquisa   

if(!empty($dados_requisicao['search']['value'])) {
    
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':andar', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':monitor', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':hostName_Antigo', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':hostName_Novo', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':login', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':sistema_Operacional', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':perifericos', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':office', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':patrimonio', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':descricao', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':local_', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':data_prev', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':data_prox', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':observacao', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':tecnico', $valor_pesq, PDO::PARAM_STR);
}

// 

// Executar a QUERY

$result_usuarios->execute();

// Ler os registros retornado do banco de dados e atribuir no array 

while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuario);

    //data_prev e data_prox com padrao BR

    $data_prev = date('d/m/Y', strtotime($data_prev));
    $data_prox = date('d/m/Y', strtotime($data_prox));

    //converter data?prox para o formato do datepicker

    $data_prox = str_replace('/', '-', $data_prox);
    $data_prox = date('Y-m-d', strtotime($data_prox));

    //se a data_prox for menor que a data atual, altera o nome Prevendo para Atrasado em vermelho

    if ($data_prox < date('Y-m-d')) {
       
        $data_prox = "<span style='color:red'>Preventiva Atrasada</span>";
    }else{
        $data_prox = date('d/m/Y', strtotime($data_prox));
    }

    // <button id="btnApagando" onclick="apagarUsuario()" >TESTE</button> criar botao para apagar
    

    $registro = [];
    $registro[] = "<input type='checkbox' value='$id' name='checkbox[]' id='checkbox[]' onclick='save($id)'>";
    $registro[] = $patrimonio;
    $registro[] = $andar;
    $registro[] = $hostName_Novo;
    $registro[] = $sistema_Operacional;
    $registro[] = $local_;
    $registro[] = $data_prox;
    $registro[] = $tecnico;
    $registro[] = "<button type='button' id='$id' class='btn btn-primary btn-sm material-symbols-outlined' onclick='visUsuario($id)'title='Visualizar Formulario'>visibility</button> <button type='button' id='$id' class='btn btn-warning btn-sm material-symbols-outlined' onclick='editUsuario($id)'title='Editar Formulario'>Edit</button> <button type='button' id='$id' class='btn btn-danger btn-sm material-symbols-outlined' onclick='apagarUsuario($id)' title='Apagar Campo'>delete</button>";
    $dados[] = $registro;
}
//$registro[] = "<button type='button' id='$id' class='btn btn-outline-primary btn-sm' onclick='visUsuario($id)'>Visualizar</button> <button type='button' id='$id' class='btn btn-outline-warning btn-sm' onclick='editUsuario($id)'>Editar</button> <button type='button' id='$id' class='btn btn-outline-danger btn-sm' onclick='apagarUsuario($id)'>Apagar</button>";
//Cria o array de informações a serem retornadas para o Javascript

$resultado = [
    "draw" => intval($dados_requisicao['draw']), // Para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), // Quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver pesquisa
    "data" => $dados // Array de dados com os registros retornados da tabela usuarios
];

// Retornar os dados em formato de objeto para o JavaScript

echo json_encode($resultado);
