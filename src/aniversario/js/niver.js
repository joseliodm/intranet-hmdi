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
