$(document).ready(function() {
    $('#listar-usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "listar_usuarios.php",
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_ páginas_TOTAL_ registros",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros no total)",
            "search": "Pesquisar:",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Próxima",
                "previous": "Anterior"
            }
        },
        "pageLength": 25,
        
    });
});

const office = document.getElementById("office");
//criar mascara para o campo office
if (office) {
    office.addEventListener("keyup", function() {
        
        office.value = office.value.replace(/[^a-zA-Z0-9]/g, "").replace(/(.{5})/g, "$1-").slice(0, 29);
        office.value = office.value.toUpperCase();
    });
}
        

function save(id){
    var valor = [];
    valor.push(id);
    console.log(valor);
    var dados = {
        'id': valor
    };
    const btnDelete = document.getElementById("btn-delete");
    btnDelete.addEventListener("click", async(e) => {
        e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'deletar.php',
        data: dados,
        success: function(response) {
            Swal.fire({
                title: 'Apagado com Sucesso!',
                icon: 'success',
                timer: 2000
            });
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
        }
    });
});
}

const apagarSelecionados = document.getElementById("apagar-selecionados");
if (apagarSelecionados) {
    apagarSelecionados.addEventListener("click", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData();
        const dados = await fetch("apagar-selected.php", {
            method: "POST",
            body: dadosForm
        });
        
        const resposta = await dados.json();
        if (resposta['status']) {
            Swal.fire({
                title: 'Tem certeza que deseja apagar todos selecionados!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, apagar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Apagado com Sucesso!',
                        'success'
                    )
                }
            })
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            document.getElementById("msgAlertErro").innerHTML = resposta['msg'];
        }
    });
}

const data_prev = document.getElementById("data_prev");
const data_prox1 = document.getElementById("data_prox");
data_prev.addEventListener("change", function() {
    const data = new Date(data_prev.value);
    data.setDate(data.getDate() + 365);
    data_prox1.value = data.toISOString().substring(0, 10);
});

const formNewUser = document.getElementById("form-cad-usuario");
const fecharModalCad = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));
if (formNewUser) {
    formNewUser.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formNewUser);
        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        if (resposta['status']) {
            Swal.fire({
                title: 'Cadastrado com Sucesso!',
                icon: 'success',
                timer: 2000
            });
            formNewUser.reset();
            fecharModalCad.hide();
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['msg'];
        }
    });
}

async function visUsuario(id) {
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();;
    if (resposta['status']) {
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        visModal.show();
        document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        document.getElementById("patrimonioUsuario").innerHTML = resposta['dados'].patrimonio;
        document.getElementById("andarUsuario").innerHTML = resposta['dados'].andar;
        document.getElementById("descricaoUsuario").innerHTML = resposta['dados'].descricao;
        document.getElementById("monitorUsuario").innerHTML = resposta['dados'].monitor;
        document.getElementById("hostnameAntigoUsuario").innerHTML = resposta['dados'].hostName_Antigo;
        document.getElementById("hostnameNovoUsuario").innerHTML = resposta['dados'].hostName_Novo;
        document.getElementById("loginUsuario").innerHTML = resposta['dados'].login;
        document.getElementById("sistemaOperacionalUsuario").innerHTML = resposta['dados'].sistema_Operacional;
        document.getElementById("perifericosUsuario").innerHTML = resposta['dados'].perifericos;
        document.getElementById("officeUsuario").innerHTML = resposta['dados'].office;
        document.getElementById("custoUsuario").innerHTML = resposta['dados'].custo;
        document.getElementById("local_Usuario").innerHTML = resposta['dados'].local_;
        document.getElementById("observacaoUsuario").innerHTML = resposta['dados'].observacao;
        document.getElementById("tecnicoUsuario").innerHTML = resposta['dados'].tecnico;
        document.getElementById("data_prevUsuario").innerHTML = resposta['dados'].data_prev;
        document.getElementById("data_proxUsuario").innerHTML = resposta['dados'].data_prox;
        const data_prev = document.getElementById("data_prevUsuario").innerHTML;
        const data_prox = document.getElementById("data_proxUsuario").innerHTML;
        document.getElementById("data_prevUsuario").innerHTML = data_prev.substring(8, 10) + "/" + data_prev.substring(5, 7) + "/" + data_prev.substring(0, 4);
        document.getElementById("data_proxUsuario").innerHTML = data_prox.substring(8, 10) + "/" + data_prox.substring(5, 7) + "/" + data_prox.substring(0, 4);
        document.getElementById("msgAlerta").innerHTML = "";
    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
}

const editModal = new bootstrap.Modal(document.getElementById("editUsuarioModal"));
async function editUsuario(id) {
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    if (resposta['status']) {
        document.getElementById("msgAlertErroEdit").innerHTML = "";
        document.getElementById("msgAlerta").innerHTML = "";
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("editandar").value = resposta['dados'].andar;
        document.getElementById("editmonitor").value = resposta['dados'].monitor;
        document.getElementById("edithostname_antigo").value = resposta['dados'].hostName_Antigo;
        document.getElementById("edithostname_novo").value = resposta['dados'].hostName_Novo;
        document.getElementById("editlogin").value = resposta['dados'].login;
        document.getElementById("editsistema_operacional").value = resposta['dados'].sistema_Operacional;
        document.getElementById("editperifericos").value = resposta['dados'].perifericos;
        document.getElementById("editoffice").value = resposta['dados'].office;
        document.getElementById("editpatrimonio").value = resposta['dados'].patrimonio;
        document.getElementById("editdescricao").value = resposta['dados'].descricao;
        document.getElementById("editcusto").value = resposta['dados'].custo;
        document.getElementById("editlocal_").value = resposta['dados'].local_;
        document.getElementById("editdata_prev").value = resposta['dados'].data_prev;
        document.getElementById("editdata_prox").value = resposta['dados'].data_prox;
        document.getElementById("editobservacao").value = resposta['dados'].observacao;
        document.getElementById("edittecnico").value = resposta['dados'].tecnico;
    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
}

const formEditUser = document.getElementById("form-edit-usuario");
if (formEditUser) {
    formEditUser.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formEditUser);
        const dados = await fetch("editar.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        if (resposta['status']) {
            await Swal.fire({
                title: 'Sucesso!',
                text: resposta['msg'],
                icon: 'success',
                confirmButtonText: 'Ok'
            });
            formEditUser.reset();
            editModal.hide();
        
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];
        }
    });
}
async function apagarUsuario(id) {
    const resultado = await Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, apague!',
        cancelButtonText: 'Não, cancele!'
    });
    
    if (resultado.value) {
        const dados = await fetch('apagar.php?id=' + id);
        const resposta = await dados.json();
        if (resposta['status']) {
            Swal.fire({
                title: 'Apagado com Sucesso!',
                icon: 'success',
                timer: 2000
            });
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
        }
    }} 

 function emailMsg(){
    const img = 'https://cdn.dribbble.com/users/8424/screenshots/1036999/dots_2.gif';
    const img2 = 'https://cdn.dribbble.com/users/8424/screenshots/1036999/dots_2.gif';
    // Exibir mensagem de aguarde depois de 2 segundos aparece a mensagem de sucesso
    Swal.fire({
        title: 'Aguarde...',
        html: '<img src="'+img+'" alt="aguarde" width="100px" height="100px" />',
        allowOutsideClick: false,
        showConfirmButton: false
    });
    setTimeout(() => {
        Swal.close();
        Swal.fire({
            title: 'Ainda carregado aguarde...',
            html: '<img src="'+img2+'" alt="sucesso" width="100px" height="100px" />',
            allowOutsideClick: false,
            showConfirmButton: false
        });
        setTimeout(() => {
            Swal.close();
        }, 50000);
    }, 7000);
}

function exibirMensagem(){
    const img = 'https://cdn.dribbble.com/users/8424/screenshots/1036999/dots_2.gif';
    Swal.fire({
        title: 'Aguarde...',
        html: '<img src="'+img+'" alt="aguarde" width="100px" height="100px" />',
        allowOutsideClick: false,
        showConfirmButton: false
    });
    setTimeout(() => {
        Swal.close();
    }, 2000);
}