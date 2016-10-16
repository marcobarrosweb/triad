<link rel="stylesheet" type="text/css" href="plugins/dataTables/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="plugins/dataTables/js/jquery.dataTables.js"></script>

<script type="text/javascript" language="javascript" >
    $(document).ready(function () {

        var dataTable = $('#employee-grid').DataTable({
            "processing": true,
            "serverSide": true,
            "aaSorting": [[0, "desc"]],
            "oLanguage": {
                "sInfo": "Mostrando _START_ com _END_ total de _TOTAL_ registro(s)",
                "sSearch": "Pesquisar:",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sEmptyTable": "Não há dados disponíveis na tabela",
                "oPaginate": {
                    "sFirst": "primeiro",
                    "sPrevious": "anterior",
                    "sNext": "próximo",
                    "sLast": "último",
                }
            },
            "ajax": {
                url: "apiPrivada.php?class=ReservaModel&method=listagem", // json datasource
                type: "post", // method  , by default get

                error: function () {  // error handling
                    $(".employee-grid-error").html("");
                    $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">Não foram encontrados dados.</th></tr></tbody>');
                    $("#employee-grid_processing").css("display", "none");
                }

            }

        });
    });
</script>

<div class="row-fluid">

    <div class="row-fluid">
        <div class="span12">
            <div class="box ">

                <div class="row">
                    <div class="col-md-10">
                        <div class="page-title">
                            <i class="icon-custom-left">
                            </i>
                            <h3>
                                Lista
                                <span class="semi-bold">
                                    Reserva de Sala
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="?inc=view/reserva/novo"><div class="btn btn-info btn-cons"> Realizar Reserva</div></a>
                    </div>
                </div>

                <div class="box-content nopadding">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <table class="table table-hover table-nomargin table-bordered" id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                            <thead>
                                <tr>
                                    <th>SALA</th>
                                    <th>RESERVA</th>
                                    <th>SOLICITANTE</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
