<!DOCTYPE html>
<html lang="pt-br">
  <head>
  
    <!-- Meta tags Obrigatórias -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="js\styled.css">
    
    <link rel="stylesheet" href="js\style.scss">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>HMDI</title>

  </head>
  <body>

  <img src="https://cdn-icons-png.flaticon.com/512/1930/1930637.png" id='balao' class="rounded float-left pulse" alt="...">
  <img src="https://cdn-icons-png.flaticon.com/512/1930/1930637.png" id='balao' class="rounded float-right pulse" alt="...">
  <div class="confetti">
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
</div>

<?php
//importar conexao
require_once 'conexao.php';
//filtrar aniversariante do me
$sql = "SELECT *  FROM aniversariantes  ORDER BY dia ASC";
$result = $conn->query($sql);
echo "<div class='container-fluid'>";
echo "<div class='row'>";
echo "<div class='col-sm-12'>";
echo "<div class='card'>";
echo "<div class='card-body'>";
echo "<h1 class='card-title text-center'>Aniversariantes do dia</h1>";
echo "</div>";
echo "</div>";
echo "</div>";

date_default_timezone_set('America/Sao_Paulo');
//verificar se existe aniversariante do mes
if ($result->rowCount() > 0) {

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $hoje = date('d');
      $dia = $row['dia'];
      $nome = $row['nome'];
      $funcao = $row['funcao'];
      if ($hoje == $dia) {
        echo "<div >";
        echo "<div >";
        echo "<div >";
        echo "<h5>$nome</h5>";
        echo "<i >Função: $funcao</i>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
    }
}
/
?>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>