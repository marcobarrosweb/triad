<?php
session_start();
session_destroy();
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
        <!-- BEGIN CORE CSS FRAMEWORK -->
        <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <!-- END CORE CSS FRAMEWORK -->
        <!-- BEGIN CSS TEMPLATE -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
        <!-- END CSS TEMPLATE -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="error-body no-top lazy">
        <div class="container">

            <div class="row login-container animated fadeInUp">
                <div class="col-md-7 col-md-offset-2 tiles white no-padding">

                    <!--CARREGADOR PRINCIPAL EXEBE AS MENSAGEM RETORNADAS-->
                    <div class="affix animated bounceIn" id="resultado" style="overflow: auto; z-index: 999999999;" ></div>
                    <!--FIM CARREGADOR PRINCIPAL-->

                    <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
                        <h2 class="normal">Controle de Salas TRIAD</h2>
                        <p>Processo seletivo<br></p>
                    </div>

                    <div class="tiles grey p-t-20 p-b-20 text-black" >

                        <div class="row"  id="show-form-login">
                            <div class="col-md-12">
                                <form id="form-login" name="form-login" class="animated fadeIn" method="POST" >
                                    <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                                        <div class="col-md-6 col-sm-6 ">
                                            <input name="email" type="text"  class="form-control" placeholder="Entre com seu E-mail">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input name="senha" id="login_pass" type="password"  class="form-control" placeholder="Sua Senha">
                                        </div>
                                    </div>
                                    <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                                        <div class="col-md-6 col-sm-6"></div>
                                        <div class="col-md-6 col-sm-6">

                                            <button class="btn btn-info btn-cons pull-right" type="submit">Entrar</button>
                                            <a class="btn btn-default btn-cons pull-right" href="#" id="bt-show-form-cadastro" >Cadastre-se</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row" style="display:none" id="show-form-cadastro">
                            <div class="col-md-12">
                                <form id="form-cadastrar-usuario" name="form" class="form-cadastrar-usuario" action="#" method="post">
                                    <!--<input type="hidden" name="acao" value="usuarioCadastrar">-->
                                    <div class="grid simple">
                                        <div class="grid-title no-border">
                                            <h4>Preencha o formulario abaixo: </h4>
                                            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                                        </div>
                                        <div class="grid-body no-border">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <div class="form-group">
                                                        <label class="form-label">Nome</label>
                                                        <div class="controls">
                                                            <input type="text" name="nome" placeholder="Nome completo" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">E-mail</label>
                                                        <div class="controls">
                                                            <input type="text" name="email" placeholder="Exemplo: xxx@xxx.xxx" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Senha</label>
                                                        <div class="controls">
                                                            <input type="password" name="senha" placeholder="Senha" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Confirmação de Senha</label>
                                                        <div class="controls">
                                                            <input type="password" name="conf_senha" placeholder="Confirmação" class="form-control">
                                                        </div>
                                                    </div>
                                                    <a href="#" class="btn btn-default btn-cons" id="bt-show-form-login">Cancelar</a>
                                                    <button type="submit" class="btn btn-info btn-cons"><i class="icon-ok"></i> Concluir cadastro</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-md-offset-2" style="text-align: center; " >
                    <br>
                    ©2016 Processo seletivo TRIAD<br>
                    Marco Barroso<br>
                </div>

            </div>
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN CORE JS FRAMEWORK-->
        <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
        <!-- BEGIN CORE TEMPLATE JS -->
        <!-- END CORE TEMPLATE JS -->

        <!-- CONTROLE JQUERY CRUD -->
        <script src="view/usuario/requisicao.js"></script>

    </body>

</html>
