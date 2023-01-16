<?php
session_start();
ob_start();
include_once '../conexao.php';
if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" type="image/x-ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="index.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container-fluid">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="/intranet/intranet-dashboard-hmdi/src/dashboard.php">
                <img src="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <h5>Bem vindo <?php echo $_SESSION['nome']; ?>!</h5>
            </a>
            <div class="container">
        <ul class=" nav-menu">
                    <li class="nav-item active">
                <a class="nav-link" target="_blank" href="http://10.1.1.108:10000/sysinfo.cgi?xnavigation=1">Configurações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/intranet/intranet-dashboard-hmdi/src/aniversario">Aniversário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/intranet/intranet-dashboard-hmdi/src/preventiva">Preventiva</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/intranet/intranet-dashboard-hmdi/src/aniversario/import">Importar-Aniversariantes</a>
            </li>
        </ul>
    </div>
    <a href="sair.php" class="btn btn-danger">Sair</a>
        </nav>
        </div>
</div>
<?php
    // Apresentar a mensagem de erro ou sucesso
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div class="container alinhar">
        <h3>Importar Lista de Aniversariantes para o Banco de Dados</h3>
        <h5>Somente Formato CSV</h5>
    </div>
    <!-- Formulario para enviar arquivo .csv -->
    <form method="POST" action="processa.php" enctype="multipart/form-data">
    <div class="container">
        <input type="file"name="arquivo" id="fileElem" multiple accept="text/csv" style="display:none" onchange="handleFiles(this.files)">
        <div class="d-flex p-2 bd-highlight flex-anexo">
            <a class="btn btn-primary btn-anexo" href="#" id="fileSelect">Anexar</a>
            <dt class="col-sm-3 text">Documentos</dt>
              <div id="fileList">
              </div>
            </div>
            <div class="div-submit">
                <input type="submit" class="btn btn-success btn-import" id="btn-submit" value="Enviar" onclick="aguarde()">
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    </form>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="import.js"></script>
</body>
</html>