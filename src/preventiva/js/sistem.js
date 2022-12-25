$(document).ready(function() {
    $('#listar-usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "listar_usuarios.php"
    });
});

const formNewUser = document.getElementById("form-cad-usuario");
const fecharModalCad = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));
if (formNewUser) {
    formNewUser.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formNewUser);
        //console.log(dadosForm);

        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        //console.log(resposta);

        if (resposta['status']) {
            //mensagem de sucesso durante 2 segundos
            Swal.fire({
                title: 'Cadastrado com Sucesso!',
                icon: 'success',
                timer: 2000
            });
            formNewUser.reset();
            fecharModalCad.hide();
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['msg'];
        }
    });
}

async function visUsuario(id) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['status']) {
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        visModal.show();

        document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        document.getElementById("patrimonioUsuario").innerHTML = resposta['dados'].patrimonio;
        document.getElementById("descricaoUsuario").innerHTML = resposta['dados'].descricao;
        document.getElementById("custoUsuario").innerHTML = resposta['dados'].custo;
        document.getElementById("local_Usuario").innerHTML = resposta['dados'].local_;
        document.getElementById("observacaoUsuario").innerHTML = resposta['dados'].observacao;
        document.getElementById("tecnicoUsuario").innerHTML = resposta['dados'].tecnico;
        document.getElementById("data_prevUsuario").innerHTML = resposta['dados'].data_prev;
        document.getElementById("data_proxUsuario").innerHTML = resposta['dados'].data_prox;

        //mudar a data_prox e data_prev para formato brasileiro
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
    //console.log("Editar: " + id);

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['status']) {
        document.getElementById("msgAlertErroEdit").innerHTML = "";

        document.getElementById("msgAlerta").innerHTML = "";
        editModal.show();

        document.getElementById("editid").value = resposta['dados'].id;
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
            // Manter a janela modal aberta
            //document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];

            // Fechar a janela modal
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            document.getElementById("msgAlertErroEdit").innerHTML = "";
            // Limpar o formulario
            formEditUser.reset();
            editModal.hide();

            // Atualizar a lista de registros
            listarDataTables = $('#listar-usuario').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];
        }
    });
}

async function apagarUsuario(id) {
    //usando SweetAlert com confirmação de Apagar ou Cancelar
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
        //console.log(resposta);
        if (resposta['status']) {
            //mensagem apagado com sucesso durante 2 segundos
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
    }
   
    } 

//ao clicar no href aparecer uma mensagem de confirmação

  $('#confirmar').on ('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Tem certeza?',
        text: "Que deseja enviar o relatorio para o email cadastrado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Enviar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            window.location.href = href;
            $('#aguarde').html('<img src="https://gifs.eco.br/wp-content/uploads/2022/07/gifs-de-aguarde-3.gif" alt="aguarde">');
        }
    })
})

function exibirMensagem(){
    Swal.fire({
        title: 'XLS!',
        text: 'Foi criado com sucesso clique para voltar!',
        icon: 'success',
        confirmButtonText: 'Ok'
    })
}




