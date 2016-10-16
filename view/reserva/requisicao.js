//  INICIO CADASTRAR
$('#form-cadastrar-reserva').submit(function (e) {//JQUERY CAPTURA O EVENTO QUANDO CLICADO NO BOTAO
    e.preventDefault();
    var carregando = $('<div class="alert"><strong>Aguarde:</strong> carregando.</div>'); //MENSAGEM DE CARREGANDO
    var arrayDados = $('#form-cadastrar-reserva').serialize(); //JQUERY SERIALIZA OS DADOS DOS FORMULARIO COLOCANDO EM VETOR
    $('#resultado').css('display', 'block');
    $.ajax({
        url: 'apiPrivada.php?method=cadastrar&class=ReservaControl', //ENVIA OS DADOS API
        dataType: 'json',
        type: 'POST', //METODO POST
        data: arrayDados, //ENVIA O ARRAY DADOS
        beforeSend: function () { //ACAO EM PROCESSO
            $('#resultado').html(carregando);//MOSTRA CARREGANDO
        },
        complete: function () {  //ACAO COMPLETADA
            $(carregando).remove();//REMOVE O CARREGANDO
        },
        success: function (data) {//ACAO COM SUCESSO

            console.log(data);
            if ($.trim(data) == 'sucesso') {
                location.href = '?inc=view/reserva/lista';//REDIRECIONADOR
            }

            if ($.trim(data) == 'erro') {
                $('#resultado').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>Não foi possível cadastrar</div></div>");//MOSTRA RESULTADO
            }

            if ($.trim(data) == 'existencia') {
                $('#resultado').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO: </strong>Conflito de horario, escolher outro</div></div>");//MOSTRA RESULTADO
            }


            if ($.trim(data) != 'sucesso' && $.trim(data) != 'erro' && $.trim(data) != 'existencia') {
                $('#resultado').html(data);//MOSTRA RESULTADO
            }

        },
        error: function (xhr, er) {//CASO OCORRA ERRO NA FUNCAO AJAX
            $('#resultado').html('<div class="da-message error  animated bounceIn">Ocorreu um erro. Por favor tente mais tarde.</div>');
        }
    });
});
//FIM CADASTRAR


//  INICIO ALTERAR
$('#form-alterar-produto').submit(function (e) {//JQUERY CAPTURA O EVENTO QUANDO CLICADO NO BOTAO
    e.preventDefault();
    var carregando = $('<div class="alert"><strong>Aguarde:</strong> carregando.</div>'); //MENSAGEM DE CARREGANDO
    var arrayDados = $('#form-alterar-produto').serialize(); //JQUERY SERIALIZA OS DADOS DOS FORMULARIO COLOCANDO EM VETOR
    $('#resultado').css('display', 'block');
    $.ajax({
        url: 'apiPrivada.php?method=alterar&class=ProdutoControl', //ENVIA OS DADOS API
        dataType: 'json',
        type: 'POST', //METODO POST
        data: arrayDados, //ENVIA O ARRAY DADOS
        beforeSend: function () { //ACAO EM PROCESSO
            $('#resultado').html(carregando);//MOSTRA CARREGANDO
        },
        complete: function () {  //ACAO COMPLETADA
            $(carregando).remove();//REMOVE O CARREGANDO
        },
        success: function (data) {//ACAO COM SUCESSO

            if ($.trim(data) == 'sucesso') {
                location.href = '?inc=view/produto/lista';//REDIRECIONADOR
            }

            if ($.trim(data) == 'erro') {
                $('#resultado').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>Não foi possível alterar</div></div>");//MOSTRA RESULTADO
            }
            if ($.trim(data) != 'sucesso' && $.trim(data) != 'erro') {
                $('#resultado').html(data);//MOSTRA RESULTADO
            }


        },
        error: function (xhr, er) {//CASO OCORRA ERRO NA FUNCAO AJAX
            $('#resultado').html('<div class="da-message error  animated bounceIn">Ocorreu um erro. Por favor tente mais tarde.</div>');
        }
    });
});
//FIM CADASTRAR



//INICIO EXCLUIR
$(document).on("click", "#produtoExcluir", function () {
    var prod_codigo = $(this).attr('prod_codigo');
    var dados = 'prod_codigo=' + prod_codigo;
    var tr = $(this).closest('tr');
    //console.log(dados);
    if (confirm("Deseja realmente excluir?")) {
        $.ajax({
            type: "POST",
            url: "apiPrivada.php?method=excluir&class=ProdutoControl",
            data: dados,
            cache: false,
            success: function (data) {//ACAO COM SUCESSO
                if ($.trim(data) == '"exclusao"') {
                    data = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-ok'></i> <strong>Atenção: </strong> Exclusão realizada com sucesso.</div>";
                    tr.remove();
                }
                if ($.trim(data) == '"erro"') {
                    data = "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-ok'></i> <strong>Atenção: </strong> Não foi possível excluir.</div>";
                }
                $('#resultado').html('<p>' + data + '</p>');

            }
        });
    }
});
//FIM EXCLUIR
