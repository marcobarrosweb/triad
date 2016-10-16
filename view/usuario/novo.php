<div class="row">
    <div class="col-md-8">
        <form id="form-cadastrar-usuario" name="form" class="form-cadastrar-usuario" action="#" method="post">
            <!--<input type="hidden" name="acao" value="usuarioCadastrar">-->
            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Cadastro de <span class="semi-bold">Usuário</span></h4>
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
                            <a href="?inc=view/usuario/lista" class="btn btn-default btn-cons">Cancelar</a>
                            <button type="submit" class="btn btn-info btn-cons"><i class="icon-ok"></i> Salvar</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
