<?php
$sala_id = $_GET["sala_id"];

//sala
$sala = new SalaControl();
$arraySala = $sala->Pesquisar($sala_id, NULL, "sala_id");
foreach ($arraySala as $dadosSala) {
    
}
?>

<div class="row">
    <div class="col-md-8">
        <form id="form-alterar-sala" name="form" class="form-alterar-sala" action="#" method="post">
            <input type="hidden" name="sala_id" value="<?php echo $dadosSala['sala_id'] ?>">

            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Alteração de <span class="semi-bold">Sala</span></h4>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="grid-body no-border"> <br>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <div class="controls">
                                    <input type="text" name="nome" value="<?php echo $dadosSala['nome'] ?>" placeholder="Nome da Sala" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <div class="controls">
                                    <textarea name="descricao" class="form-control" rows="4" cols="40" placeholder="Ex.: Sala da diretoria"><?php echo $dadosSala['descricao'] ?></textarea>
                                </div>
                            </div>
                            <a href="?inc=view/sala/lista" class="btn btn-default btn-cons">Cancelar</a>
                            <button type="submit" class="btn btn-info btn-cons">Salvar Alteração</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
