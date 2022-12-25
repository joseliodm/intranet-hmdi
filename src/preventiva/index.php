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
    <link rel="stylesheet" href="style/index.css">
    <link rel="shortcut icon" href="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" type="image/x-ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
<div class="container-fluid">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-light" id="bg-logo">
            <div class="container-fluid" id="wt-nav">
                <button id="btn-cadastro" title="Adicionar Nova Preventiva" type="button" class="btn btn-success material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">library_add</button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="./msg" id="confirmar" class="btn btn-outline-primary btn-sm material-symbols-outlined" title="Enviar Relatorio por Email" onclick="emailMsg()">mail</a>
                    </li>
                    <li class="nav-item">
                        <a href="./relatorio/gerar_planilha.php" id="confirmar" class="btn btn-outline-success btn-sm material-symbols-outlined" title="Gerar xlsx de todas as Preventivas" onclick="exibirMensagem()">description</a>
                    </li>
                    <li class="nav-item">
                        <a href="./relatorio/gerar_planilha_atrasada.php" id="confirmar" class="btn btn-outline-danger btn-sm material-symbols-outlined prev" title="gerar xlsx de Preventivas Atrasadas" onclick="exibirMensagem()">description</a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>     
    </div> 
        <span id="msgAlerta"></span> 
        <div class="container-fluid">
        <form action="deletar.php" mothod="post" nome="checkbox" id="checkbox">
            <table id="listar-usuario" class="table table-striped table-hover display " style="width:100%">
                <thead > 
                <tr> 
                    <th class="table-dark">Selecionar</th>
                    <th class="table-dark">Patrimonio</th>
                    <th class="table-dark">Andar</th>
                    <th class="table-dark">Host Name</th>
                    <th class="table-dark">Sistema Operacional</th>
                    <th class="table-dark">Local</th>
                    <th class="table-dark">Prox. Peventiva</th> 
                    <th class="table-dark">Técnico</th>
                    <th class="table-dark">ação</th>
                </tr>
            </thead>
        </table>
    </form>
</div>
</div>
<button class="material-symbols-outlined btn btn-danger" id="btn-delete" title="Deletar todos Selecionados">delete_forever</button>
    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertErroCad"></span>
                    <form method="POST" id="form-cad-usuario">
                    <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimonio" required title="Qual número do patrimônio do Desktop">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="tecnico" name="tecnico" placeholder="Tecnico"  required title="Nome do Tecnico que realizou a preventiva">
                            </div>
                    </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" id="sistema_Operacional" name="sistema_Operacional" required title="Selecione o Sistema Operacional Instalado no Desktop">
                                    <option selected required disabled>Selecione o Sistema Operacional</option>
                                    <option value="windows-10">Windows 10</option>
                                    <option value="windows-11">Windows 11</option>
                                    <option value="windows-server">Windows Server</option>
                                    <option value="linux">Linux</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" id="andar" name="andar" required title="Selecione o Andar Onde está o desktop">
                                    <option selected disabled>Selecione o Andar</option>
                                    <option value="sub-solo">Sub-solo</option>
                                    <option value="1-andar">1-Andar</option>
                                    <option value="2-andar">2-Andar</option>
                                    <option value="3-andar">3-Andar</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="hostName_Antigo" name="hostName_Antigo" placeholder="Host-Name Antigo" required title="Qual hostName Anterior">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="hostName_Novo" name="hostName_Novo" placeholder="Host-Name Novo" required title="Qual hostName adicionado"> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required title="Qual o Login de acesso (Perfil)">
                            </div>
                            <div class="col-md-6">

                                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Modelo" required title="Qual Modelo do Desktop">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="monitor" name="monitor" placeholder="Monitor" required title="Qual número do patrimônio do Monitor">
                            </div>
                            <div class="col-md-6">
                            
                                <input type="text" class="form-control" id="perifericos" name="perifericos" placeholder="Perifericos" required title="Qual Impressoa ou acessório está instalado no desktop ">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="office" name="office" placeholder="Office" required title="Informe o Codigo de ativação do office">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                         
                                <input type="text" class="form-control" id="custo" name="custo" placeholder="Custo" required title="">
                            </div>
                            <div class="col-md-6">
                         
                                <input type="text" class="form-control" id="local_" name="local_" placeholder="Local" required title="Qual Local se encontra o desktop">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                               
                                <input type="date" class="form-control" id="data_prev" name="data_prev" placeholder="Data Prevista" required title="Qual a data do inicio da preventiva">
                            </div>
                            <div class="col-md-6">
                             
                                <input type="date" class="form-control" id="data_prox" name="data_prox" placeholder="Data Proxima">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                         
                                <input type="text" class="form-control" id="observacao" name="observacao" placeholder="Observacao"  required title="Alguma observação a ser comentada para tratos futuros">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="visUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visUsuarioModalLabel">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <p id="avisoUsuario"></p>
                        <h4 class="col-sm-3">id</h4>
                        <h5 class="col-sm-9" id="idUsuario"></h5>
                        <h4 class="col-sm-3">Andar</h4>
                        <h5 class="col-sm-9" id="andarUsuario"></h5>
                        <h4 class="col-sm-3">Modelo</h4>
                        <h5 class="col-sm-9" id="descricaoUsuario"></h5>
                        <h4 class="col-sm-3">Monitor</h4>
                        <h5 class="col-sm-9" id="monitorUsuario"></h5>
                        <h4 class="col-sm-3">HostName-antigo</h4>
                        <h5 class="col-sm-9" id="hostnameAntigoUsuario"></h5>                 
                        <h4 class="col-sm-3">HostName-novo</h4>
                        <h5 class="col-sm-9" id="hostnameNovoUsuario"></h5>
                        <h4 class="col-sm-3">Login</h4>
                        <h5 class="col-sm-9" id="loginUsuario"></h5>
                        <h4 class="col-sm-3">Sistema Operacional</h4>
                        <h5 class="col-sm-9" id="sistemaOperacionalUsuario"></h5>
                        <h4 class="col-sm-3">Perifericos</h4>
                        <h5 class="col-sm-9" id="perifericosUsuario"></h5>
                        <h4 class="col-sm-3">Office</h4>
                        <h5 class="col-sm-9" id="officeUsuario"></h5>
                        <h4 class="col-sm-3">Patrimonio</h4>
                        <h5 class="col-sm-9" id="patrimonioUsuario"></h5>
                        <h4 class="col-sm-3">Tecnico</h4>
                        <h5 class="col-sm-9" id="tecnicoUsuario"></h5>
                        <h4 class="col-sm-3">Custo</h4>
                        <h5 class="col-sm-9" id="custoUsuario"></h5>
                        <h4 class="col-sm-3">Local</h4>
                        <h5 class="col-sm-9" id="local_Usuario"></h5>
                        <h4 class="col-sm-3">Data Prevista</h4>
                        <h5 class="col-sm-9" id="data_prevUsuario"></h5>
                        <h4 class="col-sm-3">Data Proxima</h4>
                        <h5 class="col-sm-9" id="data_proxUsuario"></h5>
                        <h4 class="col-sm-3">Observacao</h4>
                        <h5 class="col-sm-9" id="observacaoUsuario"></h5>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioModalLabel">Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertErroEdit"></span>
                    <form method="POST" id="form-edit-usuario">
                        <input type="hidden" name="id" id="editid">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="andar">Andar</label>
                                <select class="form-select" id="editandar" name="andar" required>
                                    <selected>Escolha o Andar</selected>
                                    <option value="sub-solo">Sub-Solo</option>
                                    <option value="1-andar">1-Andar</option>
                                    <option value="2-andar">2-Andar</option>
                                    <option value="3-andar">3-Andar</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="monitor">Monitor</label>
                                <input type="text" class="form-control" id="editmonitor" name="monitor" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="hostname_antigo">HostName-Antigo</label>
                                <input type="text" class="form-control" id="edithostname_antigo" name="hostName_Antigo" required>
                            </div>
                            <div class="col-md-6">
                                <label for="hostname_novo">HostName-Novo</label>
                                <input type="text" class="form-control" id="edithostname_novo" name="hostName_Novo" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="editlogin" name="login" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sistema_operacional">Sistema Operacional</label>
                                <select class="form-select" id="editsistema_operacional" name="sistema_Operacional" required>
                                    <selected>Seleciona o Sistema Operaconal</selected>
                                    <option value="windows-10">Windows 10</option>
                                    <option value="windows-11">Windows 11</option>
                                    <option value="windows-server">Windows Server</option>
                                    <option value="linux">Linux</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="perifericos">Perifericos</label>
                                <input type="text" class="form-control" id="editperifericos" name="perifericos" required>
                            </div>
                            <div class="col-md-6">
                                <label for="office">Office</label>
                                <input type="text" class="form-control" id="editoffice" name="office" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="patrimonio">Patrimonio</label>
                                <input type="text" class="form-control" id="editpatrimonio" name="patrimonio" required>
                            </div>
                            <div class="col-md-6">
                                <label for="descricao">Descricao</label>
                                <input type="text" class="form-control" id="editdescricao" name="descricao" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="custo">Custo</label>
                                <input type="text" class="form-control" id="editcusto" name="custo" required>
                            </div>
                            <div class="col-md-6">
                                <label for="local_">Local</label>
                                <input type="text" class="form-control" id="editlocal_" name="local_" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data_prev">Data Prevista</label>
                                <input type="date" class="form-control" id="editdata_prev" name="data_prev" required>
                            </div>
                            <div class="col-md-6">
                                <label for="data_prox">Data Proxima</label>
                                <input type="date" class="form-control" id="editdata_prox" name="data_prox" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observacao">Observacao</label>
                                <input type="text" class="form-control" id="editobservacao" name="observacao" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tecnico">Tecnico</label>
                                <input type="text" class="form-control" id="edittecnico" name="tecnico" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer id="footerColor">
        <div class="card">
            <div class="card-body bg-light">
               <span> ©Intranet-HMDI- Todos os direitos reservados: Hospital e Maternidade Dona Íris Alameda Emílio Póvoa, nº 151 - Vila Redenção - Cep: 74845-250 (62) 3956-8888</span>
                <div id="date"></div>
            </div>
        </div>
    </footer>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>                
    <script src="js/novo.js"></script>
    <script src="js/controlForm.js"></script>
</body>
</html>