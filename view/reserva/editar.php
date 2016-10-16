<?php
$prod_codigo = $_GET["codigo"];
//PRODUTO
$produto = new ProdutoControl();
$arrayProduto = $produto->Pesquisar($prod_codigo, NULL, "prod_codigo");
foreach ($arrayProduto as $dadosProduto) {
    
}

//BUSCAR TODAS MARCAS
$marca = new MarcaControl();
$arrayMarca = $marca->Pesquisar(NULL, NULL, NULL);
foreach ($arrayMarca as $dadosMarca) {
    
}
?>

<script type="text/javascript" language="javascript" src="plugins/maskMoney/jquery.maskMoney.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#preco").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
    });
</script>
<div class="row">
    <div class="col-md-6">
        <form id="form-alterar-produto" name="form" class="form-alterar-produto" action="#" method="post">
            <input type="hidden" name="prod_codigo" value="<?php echo $dadosProduto['prod_codigo'] ?>">
            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Cadastro de <span class="semi-bold">Produto</span></h4>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="grid-body no-border"> 
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <div class="controls">
                                    <input type="text" name="prod_nome" placeholder="Nome do Produto" value="<?php echo $dadosProduto['prod_nome'] ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Preço</label>
                                <div class="controls">
                                    <input type="text" name="prod_preco" id="preco" placeholder="0,00" value="<?php echo number_format($dadosProduto['prod_preco'], 2, ',', '.') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quantidade</label>
                                <div class="controls">
                                    <input type="text" name="prod_quantidade" placeholder="Informe a Quantidade" value="<?php echo $dadosProduto['prod_quantidade'] ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Marca</label>
                                <div class="  right">                                       
                                    <i class=""></i>
                                    <select name="marc_codigo" id="marca" placeholder="Selecione uma Marca" class="select2" style="width:50%"  >
                                        <?php
                                        foreach ($arrayMarca as $dadosMarca) {
                                            if ($dadosProduto['marc_codigo'] == $dadosMarca['marc_codigo']) {
                                                ?>
                                                <option selected="" value="<?php echo $dadosMarca['marc_codigo'] ?>"><?php echo $dadosMarca['marc_nome'] ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option  value="<?php echo $dadosMarca['marc_codigo'] ?>"><?php echo $dadosMarca['marc_nome'] ?></option>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Salvar</button>
                            <a href="?inc=view/produto/lista" class="btn btn-white btn-cons">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div>
</div>




