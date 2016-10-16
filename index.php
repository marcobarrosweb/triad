<?php
include_once("apiPrivada.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Projeto TRIAD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
        <!-- INICIO PLUGIN CSS -->
        <link href="assets/plugins/bootstrap-datapicker/css/datapicker.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>

        <!-- FIM PLUGIN CSS -->

        <!-- INICIO CORE CSS FRAMEWORK -->
        <!--<link href="vendor/twbs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="vendor/twbs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="vendor/twbs/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>

        <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <!-- FIM CORE CSS FRAMEWORK -->

        <!-- INICIO CSS TEMPLATE -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
        <!-- FIM CSS TEMPLATE -->
    </head>
    <!-- FIM HEAD -->


    <!-- INICIO BODY -->
    <body class="condense-menu pace-done">


        <!-- INICIO HEADER -->
        <div class="page-container row">
            <div class="header navbar navbar-inverse " >
                <!-- INICIO TOP NAVIGATION BAR -->
                <div class="navbar-inner">
                    <div class="header-seperation" >
                        <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                            <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" > <i class="fa fa-bars top-menu-toggle-white"></i> </a> </li>
                        </ul>
                        <!-- INICIO LOGO -->
                        <ul class="nav quick-section">

                            <?php if ($_SESSION['perfil'] == 2) { ?>
                                <li class="quicklinks">
                                    <a href="?inc=view/usuario/lista" class="" >
                                        <div class="btn btn-default">Usuários</div>
                                    </a>
                                </li>
                                <li class="quicklinks">
                                    <a href="?inc=view/sala/lista" class="" >
                                        <div class="btn btn-default">Sala</div>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="quicklinks">
                                <a href="?inc=view/reserva/lista" class="" >
                                    <div class="btn btn-default">Reservas</div>
                                </a>
                            </li>
                            <li class="quicklinks">
                                <a href="#" id="sair" class="" >
                                    <div class="btn btn-default">Sair</div>
                                </a>
                            </li>



                        </ul>

                        <!-- FIM LOGO -->

                    </div>
                    <!-- FIM RESPONSIVE MENU TOGGLER -->
                    <div class="header-quick-nav" >
                        <!-- INICIO TOP NAVIGATION MENU -->
                        <div class="pull-left">
                            <ul class="nav quick-section">
                                <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
                                        <div class="iconset top-menu-toggle-dark"></div>
                                    </a> </li>
                            </ul>
                            <ul class="nav quick-section">
                                <?php if ($_SESSION['perfil'] == 2) { ?>
                                    <li class="quicklinks">
                                        <a href="?inc=view/usuario/lista" class="" >
                                            <div class="btn btn-default">Usuários</div>
                                        </a>
                                    </li>
                                    <li class="quicklinks">
                                        <a href="?inc=view/sala/lista" class="" >
                                            <div class="btn btn-default">Sala</div>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="quicklinks">
                                    <a href="?inc=view/reserva/lista" class="" >
                                        <div class="btn btn-default">Reservas</div>
                                    </a>
                                </li>



                            </ul>

                        </div>

                        <div class="pull-right">
                            <div class="chat-toggler">

                                <ul class="nav ">
                                    <li><div class="user-details">
                                            <div class=""> Olá <strong><?php echo $_SESSION['nome']; ?></strong> </div>
                                        </div></li>
                                    <li class="quicklinks">
                                        <a href="#" id="sair" >
                                            <div class="btn btn-info btn-sm btn-small "> Sair</div>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                        </div>


                        <!-- FIM TOP NAVIGATION MENU -->

                    </div>

                    <!-- FIM TOP NAVIGATION MENU -->

                </div>
                <!-- FIM TOP NAVIGATION BAR -->
            </div>
            <!-- FIM HEADER -->
            <!-- INICIO CONTAINER -->
            <div class="page-container row-fluid">
                <!-- INICIO SIDEBAR -->

                <!-- FIM SIDEBAR -->
                <!-- INICIO PAGE CONTAINER-->
                <div class="page-content">
                    <!-- INICIO SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                    <div class="clearfix"></div>
                    <div class="content container">
                        <!--CARREGADOR PRINCIPAL EXEBE AS MENSAGEM RETORNADAS DAS VALIDAÇÕES-->
                        <div class="affix  animated bounceIn" id="resultado" style="overflow: auto; z-index: 999999999;" ></div>
                        <!--FIM CARREGADOR PRINCIPAL-->
                        <!--INICIO INCLUDE DE PÁGINAS-->
                        <?php
                        //$inc=isset($_REQUEST["inc"])? $_REQUEST["inc"]: "home-profissional";
                        $inc = isset($_REQUEST["inc"]) ? $_REQUEST["inc"] : "view/reserva/lista";
                        include("" . $inc . ".php"); //INCLUI AS PÁGINAS RECEBIDAS VIA GET PELO ?inc=PAGINA
                        ?>
                        <!--FIM INCLUDE DE PÁGINAS-->

                    </div>
                </div>
            </div>
            <!-- FIM CONTAINER -->
            <!-- INICIO CHAT -->

        </div>
        <!-- FIM CONTAINER -->

        <!-- INICIO CORE JS FRAMEWORK-->
        <script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <!-- <script src="vendor/twbs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- INICIO PAGE LEVEL PLUGINS -->
        <script src="assets/plugins/bootstrap-datapicker/js/bootstrap-datapicker.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>


        <!-- INICIO DATA TABLE -->
        <script src="assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
        <script src="assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript" ></script>
        <script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
        <script src="assets/js/datatables.js" type="text/javascript"></script>
        <!-- FIM DATA TABLE -->

        <!--SCRIPT INICIALIZAÇÃO DE COMPONENTES-->
        <script src="assets/js/form_elements.js"></script>

        <!-- CONTROLE JQUERY CRUD -->
        <script src="view/usuario/requisicao.js"></script>
        <script src="view/sala/requisicao.js"></script>
        <script src="view/reserva/requisicao.js"></script>


    </body>
</html>
