<?php
//BUSCAR TODAS MARCAS
$marca = new SalaControl();
$arraySala = $marca->Pesquisar(NULL, NULL, NULL);
foreach ($arraySala as $dadosSala) {
    
}
?>

<div class="row">
    <div class="col-md-8">
        <form id="form-cadastrar-reserva" name="form" class="form-cadastrar-reserva" action="#" method="post">
            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Reserva de  <span class="semi-bold">Sala</span></h4>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="grid-body no-border">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Selecione a Sala</label>
                                <div class="  right">
                                    <i class=""></i>
                                    <select name="sala_id" id="sala" placeholder="Selecione uma Sala" class="select2 form-control" >
                                        <option value=""></option>
                                        <?php
                                        foreach ($arraySala as $dadosSala) {
                                            ?>
                                            <option value="<?php echo $dadosSala['sala_id'] ?>"><?php echo $dadosSala['nome'] ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="form-label">Data Inicial</label>
                                <div class="controls">
                                    <input type="text" id="data_inicio" name="data_inicio" placeholder="00/00/0000" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Hora Inicial</label>
                                <div class="controls">
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" name="hora_inicio" class="form-control" >
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Data Final</label>
                                <div class="controls">
                                    <input type="text" id="data_fim" name="data_fim" placeholder="00/00/0000" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Hora final</label>
                                <div class="controls">
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" name="hora_fim" class="form-control">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="?inc=view/reserva/lista" class="btn btn-default btn-cons">Cancelar</a>
                    <button type="submit" class="btn btn-info btn-cons">Salvar</button>

                </div>
            </div>
    </div>
</form>
</div>
</div>
