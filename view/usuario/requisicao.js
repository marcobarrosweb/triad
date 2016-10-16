//INICIO LOGAR
$('#form-login').submit(function (e) {//JQUERY CAPTURA O EVENTO QUANDO CLICADO NO BOTAO
    e.preventDefault();
    var carregando = $('<div class="alert"><strong>Aguarde:</strong> carregando.</div>'); //MENSAGEM DE CARREGANDO
    var arrayDados = $('#form-login').serialize(); //JQUERY SERIALIZA OS DADOS DOS FORMULARIO COLOCANDO EM VETOR
    $('#resultado').css('display', 'block');
    $.ajax({
        url: 'apiPublica.php?method=logar&class=UsuarioControl', //ENVIA OS DADOS API
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
                location.href = 'index.php?inc=view/reserva/lista';
            }

            if ($.trim(data) == 'erro') {
                $('#resultado').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO: </strong>Não foi possível logar, verifique usuário ou senha.</div></div>");//MOSTRA RESULTADO
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
//FIM LOGAR

//INICIO SAIR
$(document).on("click", "#sair", function () {
    if (confirm("Deseja realmente sair?")) {
        $.ajax({
            url: "apiPrivada.php?method=sair&class=UsuarioControl",
            dataType: 'json',
            type: "POST",
            success: function (data) {
                if ($.trim(data) == 'sucesso') {
                    location.href = 'login.php';
                }
            }
        });
    }
});


//  INICIO CADASTRAR
$('#form-cadastrar-usuario').submit(function (e) {//JQUERY CAPTURA O EVENTO QUANDO CLICADO NO BOTAO
    e.preventDefault();
    var carregando = $('<div class="alert"><strong>Aguarde:</strong> carregando.</div>'); //MENSAGEM DE CARREGANDO
    var arrayDados = $('#form-cadastrar-usuario').serialize(); //JQUERY SERIALIZA OS DADOS DOS FORMULARIO COLOCANDO EM VETOR
    $('#resultado').css('display', 'block');
    $.ajax({
        url: 'apiPublica.php?method=cadastrar&class=UsuarioControl', //ENVIA OS DADOS API
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

            if ($.trim(data) == 'sucesso-redireciona-reserva') {
                location.href = '?inc=view/reserva/lista';//REDIRECIONADOR
            }
            if ($.trim(data) == 'sucesso-redireciona-lista-usuario') {
                location.href = '?inc=view/usuario/lista';//REDIRECIONADOR
            }

            if ($.trim(data) == 'naologado') {
                $('#resultado').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Cadastro reaizado com sucesso, efetue o login abaixo:</strong></div></div>");//MOSTRA RESULTADO
                $('#show-form-cadastro').hide(); //SUMIR FORM CADASTRO DE USUARIO login
                $('#show-form-login').show(); //EXIBIR FORM LOGIN
            }

            if ($.trim(data) == 'erro') {
                $('#resultado').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>Não foi possível alterar</div></div>");//MOSTRA RESULTADO
            }

            if ($.trim(data) == 'existencia') {
                $('#resultado').html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO: </strong>Usuário já cadastrado</div></div>");//MOSTRA RESULTADO
            }


            if ($.trim(data) != 'sucesso-redireciona-reserva' && $.trim(data) != 'sucesso-redireciona-lista-usuario' && $.trim(data) != 'erro' && $.trim(data) != 'existencia' && $.trim(data) != 'naologado') {
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
$('#form-alterar-usuario').submit(function (e) {//JQUERY CAPTURA O EVENTO QUANDO CLICADO NO BOTAO
    e.preventDefault();
    var carregando = $('<div class="alert"><strong>Aguarde:</strong> carregando.</div>'); //MENSAGEM DE CARREGANDO
    var arrayDados = $('#form-alterar-usuario').serialize(); //JQUERY SERIALIZA OS DADOS DOS FORMULARIO COLOCANDO EM VETOR
    $('#resultado').css('display', 'block');
    $.ajax({
        url: 'apiPrivada.php?method=alterar&class=UsuarioControl', //ENVIA OS DADOS API
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
                location.href = '?inc=view/usuario/lista';
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
$(document).on("click", "#usuarioExcluir", function () {
    var usuario_id = $(this).attr('usuario_id');
    var dados = 'usuario_id=' + usuario_id;
    var tr = $(this).closest('tr');
    //console.log(dados);
    if (confirm("Deseja realmente excluir?")) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "apiPrivada.php?method=excluir&class=UsuarioControl",
            data: dados,
            cache: false,
            success: function (data) {//ACAO COM SUCESSO
                //console.log(data);


                if ($.trim(data) == 'exclusao') {
                    data = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-ok'></i> <strong>Atenção: </strong> Exclusão realizada com sucesso.</div>";
                    tr.remove();
                }

                if ($.trim(data) == "vinculo") {
                    data = "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-ok'></i> <strong>Atenção:</strong> Exclusão não realizada, este usuário possui reserva(s).</div>";
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


//HABILITAR FORM CADASTRO USUARIO TELA LOGIN
$(document).on('click', '#bt-show-form-cadastro', function () {
    $('#show-form-cadastro').show();
    $('#show-form-login').hide();

});

//HABILITAR FORM LOGIN USUARIO TELA LOGIN
$(document).on('click', '#bt-show-form-login', function () {
    $('#show-form-cadastro').hide();
    $('#show-form-login').show();

});


//HABILITAR ALTERAR SENHA
$(document).on('click', '#botaoAlterarSenha', function () {

    $('#botaoAlterarSenha').hide();
    $('#novaSenha').show();
    document.form.senha_verifica.value = 1;

});
//DESABILITAR ALTERAR SENHA
$(document).on('click', '#cancelarAlterarSenha', function () {

    $('#botaoAlterarSenha').show()
    $('#novaSenha').hide()
    document.form.senha_verifica.value = 0;

});
