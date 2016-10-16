<?php
$usuario_id = $_GET["usuario_id"];

//USUARIO
$usuario = new UsuarioControl();
$arrayUsuario = $usuario->Pesquisar($usuario_id, NULL, "usuario_id");
foreach ($arrayUsuario as $dadosUsuario) {
    
}
?>

<div class="row">
    <div class="col-md-8">
        <form id="form-alterar-usuario" name="form" class="form-alterar-usuario" action="#" method="post">
            <!--<input type="hidden" name="acao" value="usuarioAtualizar">-->
            <input type="hidden" name="usuario_id" value="<?php echo $dadosUsuario['usuario_id'] ?>">
            <input type="hidden" name="senha" value="<?php echo $dadosUsuario['senha'] ?>">
            <input type="hidden" name="senha_verifica" value="0">

            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Alteração de <span class="semi-bold">Usuário</span></h4>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="grid-body no-border"> <br>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <div class="controls">
                                    <input type="text" name="nome" value="<?php echo $dadosUsuario['nome'] ?>" placeholder="Nome completo" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">E-mail</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $dadosUsuario['email'] ?>"  name="email" placeholder="Exemplo: xxx@xxx.xxx" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="form-label">Senha</label>
                                <div class="controls" id="botaoAlterarSenha">
                                    <button type="button" id="alterarSenha" class="btn btn-default btn-cons">Alterar senha</button>
                                </div>
                                <div class="controls" id="novaSenha" style="display: none">
                                    <input type="password"  name="senha_nova" placeholder="Nova senha" class="form-control">
                                    <button type="button" id="cancelarAlterarSenha" class="btn btn-white btn-cons">Cancelar alteração senha</button>
                                </div>
                            </div>
                            <a href="?inc=view/usuario/lista" class="btn btn-default btn-cons">Cancelar</a>
                            <button type="submit" class="btn btn-info btn-cons"><i class="icon-ok"></i> Salvar Alteração</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
