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
    <meta charset="utf-8">
    <title>HMDI</title>
    <link rel="stylesheet" href="js/global.css">
    <link rel="shortcut icon" href="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" type="image/x-ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
<div class="container-fluid">
    <div class="container-fluid">
        <img src="../imagens/logo.png" class="img-fluid" alt="Imagem responsiva" id="imagem">    
    </div> 
        <span id="msgAlerta"></span> 
        <div class="container-fluid">
        <form action="deletar.php" mothod="post" nome="checkbox" id="checkbox">
            <table id="listar-usuario" class="table table-striped table-hover display " style="width:100%">
                <thead > 
                <tr> 
                    <th class="table-dark">ID</th>
                    <th class="table-dark">Nome</th>
                    <th class="table-dark">Função</th>
                    <th class="table-dark">Dia</th>
                </tr>
            </thead>
        </table>
    </form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="js/niver.js"></script>
</body>
</html>