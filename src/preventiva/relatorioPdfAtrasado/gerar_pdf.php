<?php

// Carregar o Composer
require './vendor/autoload.php';

// Incluir conexao com BD
include_once './conexao.php';

// QUERY para recuperar os registros do banco de dados
$query_usuarios = "SELECT patrimonio, descricao, custo, local_, data_prev, data_prox, observacao, tecnico FROM computadores";

// Prepara a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

// Executar a QUERY
$result_usuarios->execute();
$data_atual = date('d/m/Y');
// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<title>HMDI-PREVENTIVAS</title>";
$dados .= "</head>";
$dados .= "<body>";
//colocar logo
$dados .= "<img src='https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png' width='100' height='100' align='left'>";
//h1 com o nome do relatorio e a data atual
$dados .= "<h1>MANUTENÇÕES PREVENTIVAS ATRASADAS- TEC. DA INFORMAÇÃO</h1>";
$dados .= "<h2>Data: $data_atual</h2>";

// Criar tabela posicao absoluta para o PDF com 100% de largura e altura da pagina e com borda 1px solid #000 (preto) e margem de 0px para todos os lados (top, right, bottom, left) 
$dados .= "<table style=' width: 100%; height: 100%; left: 10px;'>";
$dados .= "<tr>";
//PATRIMONIO com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>PATRIMONIO</b></td>";
//DESCRICAO com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>DESCRICAO</b></td>";
//CUSTO com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>CUSTO</b></td>";
//LOCAL com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>LOCAL</b></td>";
//DATA PREV com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>DATA PREV</b></td>";
//DATA PROX com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>DATA PROX</b></td>";
//OBSERVACAO com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>OBSERVACAO</b></td>";
//TECNICO com background color #0d6efd e font color #ffffff
$dados .= "<td style='background-color: #0d6efd; color: #ffffff;'><b>TECNICO</b></td>";
$dados .= "</tr>";

// Recuperar so os que estao atrasados data_prox < data_atual
while ($row_usuarios = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    $data_prox = $row_usuarios['data_prox'];
    $data_atual = date('Y-m-d');
    if ($data_prox < $data_atual) {
        //converter data para o formato brasileiro
        $data_prox = date('d/m/Y', strtotime($data_prox));
        $data_prev = date('d/m/Y', strtotime($row_usuarios['data_prev']));
        $dados .= "<tr>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $row_usuarios['patrimonio'] . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $row_usuarios['descricao'] . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $row_usuarios['custo'] . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $row_usuarios['local_'] . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $data_prev . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $data_prox . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $row_usuarios['observacao'] . "</b></td>";
        $dados .= "<td style='width: 100px; height: 50px; background-color: #f8f9fa; color: #000000;'><b>" . $row_usuarios['tecnico'] . "</b></td>";
        $dados .= "</tr>";
    } else{
        $dados .= "<tr>";
        $dados .= "<td>Não existe preventivas atrasadas</td>";
        $dados .= "</tr>";
    }
}

$dados .= "</body>";


// Referenciar o namespace Dompdf

use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf

$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF

$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//imprimir no formato paisagem com tamanho A4 100% 

$dompdf->setPaper('A4', 'landscape');


// Renderizar o HTML como PDF

$dompdf->render();

// Gerar o PDF

$dompdf->stream();