<!DOCTYPE html>
<html lang="pt-br">
                                          
<head> 
    <meta charset="utf-8">
    <title>HMDI</title>
    <link rel="stylesheet" href="style/stylo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
                                                                                               
<body>
  
    <div class="container">

  

         
    <img src="imagens\logo.png" class="img-fluid" alt="Imagem responsiva">
            <a href="./msg" id="confirmar" class="btn btn-outline-primary btn-sm">Enviar relatorio de atrasadas por Email</a>
            <a href="./relatorio/gerar_planilha.php" id="confirmar" class="btn btn-outline-success btn-sm" onclick="exibirMensagem()">Imprimir relatorio geral para xls</a>
            <a href="./relatorio/gerar_planilha_atrasada.php" id="confirmar" class="btn btn-outline-success btn-sm" onclick="exibirMensagem()">Imprimir preventivas atrasadas</a>
            <div id="aguarde"></div>
 
            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastrar</button>
    </div> 
        <span id="msgAlerta"></span> 
  
        <table id="listar-usuario" class="table table-striped table-hover display" style="width:100%">
            <thead> 
                <tr> 
                    <th>id</th>
                    <th>patrimonio</th>
                    <th>descricao</th>
                    <th>local_</th>
                    <th>data_prev</th>
                    <th>data_prox</th> 
                    <th>observacao</th>
                    <th>tecnico</th>
                    <th>ação</th>
                </tr>
            </thead>
        </table>
    </div>
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
                                <label for="patrimonio">Patrimonio</label>
                                <input type="text" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimonio">
                            </div>
                            <div class="col-md-6">
                                <label for="descricao">Descricao</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="custo">Custo</label>
                                <input type="text" class="form-control" id="custo" name="custo" placeholder="Custo">
                            </div>
                            <div class="col-md-6">
                                <label for="local_">Local</label>
                                <input type="text" class="form-control" id="local_" name="local_" placeholder="Local">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data_prev">Data Prevista</label>
                                <input type="date" class="form-control" id="data_prev" name="data_prev" placeholder="Data Prevista">
                            </div>
                            <div class="col-md-6">
                                <label for="data_prox">Data Proxima</label>
                                <input type="date" class="form-control" id="data_prox" name="data_prox" placeholder="Data Proxima">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observacao">Observacao</label>
                                <input type="text" class="form-control" id="observacao" name="observacao" placeholder="Observacao">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tecnico">Tecnico</label>
                                <input type="text" class="form-control" id="tecnico" name="tecnico" placeholder="Tecnico">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visUsuarioModalLabel">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <p id="avisoUsuario"></p>
                        <dt class="col-sm-3">id</dt>
                        <dd class="col-sm-9" id="idUsuario"></dd>
                        <dt class="col-sm-3">Patrimonio</dt>
                        <dd class="col-sm-9" id="patrimonioUsuario"></dd>
                        <dt class="col-sm-3">Descricao</dt>
                        <dd class="col-sm-9" id="descricaoUsuario"></dd>
                        <dt class="col-sm-3">Custo</dt>
                        <dd class="col-sm-9" id="custoUsuario"></dd>
                        <dt class="col-sm-3">Local</dt>
                        <dd class="col-sm-9" id="local_Usuario"></dd>
                        <dt class="col-sm-3">Data Prevista</dt>
                        <dd class="col-sm-9" id="data_prevUsuario"></dd>
                        <dt class="col-sm-3">Data Proxima</dt>
                        <dd class="col-sm-9" id="data_proxUsuario"></dd>
                        <dt class="col-sm-3">Observacao</dt>
                        <dd class="col-sm-9" id="observacaoUsuario"></dd>
                        <dt class="col-sm-3">Tecnico</dt>
                        <dd class="col-sm-9" id="tecnicoUsuario"></dd>
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
                                <label for="patrimonio">Patrimonio</label>
                                <input type="text" class="form-control" id="editpatrimonio" name="patrimonio" placeholder="Patrimonio">
                            </div>
                            <div class="col-md-6">
                                <label for="descricao">Descricao</label>
                                <input type="text" class="form-control" id="editdescricao" name="descricao" placeholder="Descricao">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="custo">Custo</label>
                                <input type="text" class="form-control" id="editcusto" name="custo" placeholder="Custo">
                            </div>
                            <div class="col-md-6">
                                <label for="local_">Local</label>
                                <input type="text" class="form-control" id="editlocal_" name="local_" placeholder="Local">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data_prev">Data Prevista</label>
                                <input type="date" class="form-control" id="editdata_prev" name="data_prev" placeholder="Data Prevista">
                            </div>
                            <div class="col-md-6">
                                <label for="data_prox">Data Proxima</label>
                                <input type="date" class="form-control" id="editdata_prox" name="data_prox" placeholder="Data Proxima">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observacao">Observacao</label>
                                <input type="text" class="form-control" id="editobservacao" name="observacao" placeholder="Observacao">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tecnico">Tecnico</label>
                                <input type="text" class="form-control" id="edittecnico" name="tecnico" placeholder="Tecnico">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer id="footerColor">
        <div class="footer-copyright text-center py-3">
            <a href="http://10.1.1.108/intranet/">©Intranet-HMDI- Todos os direitos reservados: Hospital e Maternidade Dona Íris Alameda Emílio Póvoa, nº 151 - Vila Redenção - Cep: 74845-250 (62) 3956-8888</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="js/sistem.js"></script>
    
</body>

</html>
