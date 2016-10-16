<?php

class UsuarioControl {
    //METODO DESLOGAR
    public function sair() {
        session_destroy();
        return('sucesso');
    }

    //METODO LOGAR
    public function logar() {
        $dados = $_POST;
        $erros = 0; //sem erro
        $msg = ""; //sem mensagem
        $emailVerifica = 0;

        //tratamento dos erros que podem ocorrer como: campo em branco entre outros.
        //valida CPF

        if ($dados["email"] == "" || $dados["email"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>E-mail: </strong> não informado.</span></div>";
        }
        if ($dados["email"] != "" || $dados["email"] != NULL) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (preg_match($regex, $dados["email"])) {
                //EMAIL OK;
            } else {
                $erros++;
                $msg .= "<div><span><strong>E-mail: </strong> Inválido.</span></div>";
                //return false;
            }
        }
        if ($dados["senha"] == " " || $dados["senha"] == NULL) {
            $erros++;
            $msg .= "<div>
                    <span><strong>Senha: </strong> não informada. </span>
            </div>";
        }

        //exibir erro
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //sem erro
        if ($erros == 0) {

            $usuarioModel = new UsuarioModel(); //CRIA OBJETO USUARIO MODEL
            $dados['senha'] = md5($dados['senha']);
            $resultado = $usuarioModel->logar($dados); //CHAMADA METODO LOGAR
            //session_start();

            if (sizeof($resultado) > 0) {

                foreach ($resultado as $dadosUsuario) {
                    //OBTER PRIMEIRO NOME
                    $primeioNome = explode(" ", $dadosUsuario['nome']);
                    $_SESSION['nome'] = $primeioNome[0];
                    $_SESSION['usuario_id'] = $dadosUsuario['usuario_id'];
                    $_SESSION['perfil'] = $dadosUsuario['perfil'];
                    return ('sucesso');
                }
            } else {
                return('erro');
            }
        }//fim erro
    }

    /* -Fim do Metodo - */

    //INICIO METODO PESQUISA
    public function pesquisar($palavra, $palavraChave, $coluna) {
        $usuarioModel = new UsuarioModel(); //CRIA OBJETO MODELO
        $resultado = $usuarioModel->Pesquisar($palavra, $palavraChave, $coluna); //CHAMADA METODO PESQUISAR
        return ($resultado);
    }

    //METODO VERIFICA VINCULO COM OUTRAS TABELAS
    public function verificaVinculo($usuario_id) {
        $usuarioModel = new UsuarioModel(); //CRIA OBJETO MODELO
        $resultado = $usuarioModel->verificaVinculo($usuario_id); //CHAMADA METODO PESQUISAR
        return ($resultado);
    }

    //INIIO METODO EXCLUIR
    public function excluir() {
        $usuarioModel = new UsuarioModel(); //CRIA OBJETO MODELO
        $dados = $_POST; //REPASSA O usuario_id
        //VERIFICAR VINCULO COM A TABELA DE PRODUTOS
        $resultadoVinculo = $this->verificaVinculo($dados['usuario_id']);

        if (sizeof($resultadoVinculo) == 0) { //caso retorne 0 proseguir com a Exclusao
            $resultado = $usuarioModel->excluir($dados); //CHAMADA METODO EXCLUIR com o usuario_id
            if (sizeof($resultado) == 1) { //caso retorne 1 Exclusão realizada com sucesso
                return ('exclusao');
            } else { //caso retorne 0 Não foi possível excluir
                return ('erro');
            }
        } else {
            return ('vinculo');
        }
    }

    //INICIO METODO CADASTRAR
    public function cadastrar() {
        $dados = $_POST;
        $erros = 0; //Variável de erro
        $msg = ""; //Variável mensagem
        //Tratamento dos erros que podem ocorrer como: campo em branco entre outros.

        if ($dados["nome"] == " " || $dados["nome"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Nome: </strong> não informado.</span></div>";
        }
        if ($dados["email"] == "" || $dados["email"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>E-mail: </strong> não informado.</span></div>";
        }
        if ($dados["email"] != "" || $dados["email"] != NULL) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (preg_match($regex, $dados["email"])) {
                //EMAIL OK;
            } else {
                $erros++;
                $msg .= "<div><span><strong>E-mail: </strong> Inválido.</span></div>";
                //return false;
            }
        }
        if ($dados["senha"] == "" || $dados["senha"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Senha: </strong> não informada.</span></div>";
        }
        if ($dados["conf_senha"] == "" || $dados["conf_senha"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Confirmação de senha: </strong> não informada.</span></div>";
        }

        if ($dados["senha"] != "" && $dados["conf_senha"] != "") {

            if ($dados["senha"] != $dados["conf_senha"]) {
                $erros++;
                $msg .= "<div><span><strong>Senhas: </strong> diferentes.</span></div>";
            }
        }


        //Se existir Erro exibe mensagem
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //Caso não exista Erro no formulario
        else {
            $usuarioModel = new UsuarioModel(); //CRIA OBJETO MODELO
            $resultadoExistencia = $usuarioModel->pesquisar($dados["email"], NULL, "email"); //Verifica se usuário já cadastrado.
            if (sizeof($resultadoExistencia) > 0) {//Verifica a quatidade de linhas atigidas na consulta
                //echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-warning-sign'></i>  Usuário já cadastrado.</div>";
                return ('existencia');
            }
            if (sizeof($resultadoExistencia) == 0) {//Caso retorne  0  procegue o cadastro.
                //PREPARA DADOS PARA BANCO
                $dados['senha'] = md5($dados['senha']); //Criptografia MD5 da senha para o Banco.

                if (!$dados['perfil']) {
                    $dados['perfil'] = 1;
                }

                $resultadoCadastro = $usuarioModel->cadastrar($dados); //Aciona o metodo cadastrar do modelo.
                //Caso retorne 1 cadastro com sucesso
                if (sizeof($resultadoCadastro) == 1) {
                    //CADASTRO FEITO PELO LOGIN IRA CRIAR A SESSAO E ENTRAR AUTOMATICAMENTE NO SISTEMA
                    if (isset($_SESSION['usuario_id'])) {
                        if ($_SESSION['perfil'] == 1) {
                            return ('sucesso-redireciona-reserva');
                        } else {
                            return ('sucesso-redireciona-lista-usuario');
                        }
                    } else {
                        return ('naologado');
                    }
                    //echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-ok'></i>  Cadastro realizado com sucesso</div>";
                    //echo "<script>location.href='?inc=view/usuario/lista';</script>";
                }
                //Cado retorne 0 Não foi possível cadastrar
                else {
                    return ('erro');
                }
            }
            return $json;
        }//fim erro
    }

    //FIM METODO CADASTRAR
    //INICIO METODO ALTERAR
    public function alterar() {
        $dados = $_POST;
        $msg = '';
        $erros = 0; //Variável de erro
        //Tratamento dos erros que podem ocorrer como: campo em branco entre outros.

        if ($dados["nome"] == " " || $dados["nome"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Nome: </strong> não informado.</span></div>";
        }
        if ($dados["email"] == "" || $dados["email"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>E-mail: </strong> não informado.</span></div>";
        }
        if ($dados["email"] != "" || $dados["email"] != NULL) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (preg_match($regex, $dados["email"])) {
                //return true;
            } else {
                $erros++;
                $msg .= "<div><span><strong>E-mail: </strong> Inválido.</span></div>";
                //return false;
            }
        }
        if ($dados["senha_verifica"] == 1) {
            if ($dados["senha_nova"] == " " || $dados["senha_nova"] == NULL) {
                $erros++;
                $msg .= "<div><span><strong>Nova Senha: </strong> não informada.</span></div>";
            }
        }

        //se erro for maior que 0 exibe a mensagem
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //caso contrário sem erro
        else {
            $usuarioModel = new UsuarioModel(); //CRIA OBJETO MODELO
            if ($dados["senha_verifica"] == 1) {//VERIFICA E PREPARA A SENHA PARA O BANCO
                $dados['senha'] = md5($dados['senha_nova']);
            } else {
                $dados['senha'] = $dados['senha'];
            }
            $resultado = $usuarioModel->alterar($dados);
            if (sizeof($resultado) > 0) {//caso retorne  0  procegue o cadastro
                return('sucesso');
            } else {
                return('erro');
            }
        }
    }

    //INICIO METODO CADASTRAR
    public function primeiroCadastro() {
        $dados = $_POST;
        $erros = 0; //Variável de erro
        $msg = ""; //Variável mensagem
        //Tratamento dos erros que podem ocorrer como: campo em branco entre outros.

        if ($dados["nome"] == " " || $dados["nome"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Nome: </strong> não informado.</span></div>";
        }
        if ($dados["email"] == "" || $dados["email"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>E-mail: </strong> não informado.</span></div>";
        }
        if ($dados["email"] != "" || $dados["email"] != NULL) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (preg_match($regex, $dados["email"])) {
                //EMAIL OK;
            } else {
                $erros++;
                $msg .= "<div><span><strong>E-mail: </strong> Inválido.</span></div>";
                //return false;
            }
        }
        if ($dados["senha"] == "" || $dados["senha"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Senha: </strong> não informada.</span></div>";
        }
        if ($dados["conf_senha"] == "" || $dados["conf_senha"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Confirmação de senha: </strong> não informada.</span></div>";
        }

        if ($dados["senha"] != "" && $dados["conf_senha"] != "") {

            if ($dados["senha"] != $dados["conf_senha"]) {
                $erros++;
                $msg .= "<div><span><strong>Senhas: </strong> diferentes.</span></div>";
            }
        }


        //Se existir Erro exibe mensagem
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //Caso não exista Erro no formulario
        else {
            $usuarioModel = new UsuarioModel(); //CRIA OBJETO MODELO
            $resultadoExistencia = $usuarioModel->pesquisar($dados["email"], NULL, "email"); //Verifica se usuário já cadastrado.
            if (sizeof($resultadoExistencia) > 0) {//Verifica a quatidade de linhas atigidas na consulta
                //echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-warning-sign'></i>  Usuário já cadastrado.</div>";
                return ('existencia');
            }
            if (sizeof($resultadoExistencia) == 0) {//Caso retorne  0  procegue o cadastro.
                //PREPARA DADOS PARA BANCO
                $dados['senha'] = md5($dados['senha']); //Criptografia MD5 da senha para o Banco.
                $resultadoCadastro = $usuarioModel->cadastrar($dados); //Aciona o metodo cadastrar do modelo.
                //Caso retorne 1 cadastro com sucesso
                if (sizeof($resultadoCadastro) == 1) {
                    return ('sucesso');
                    //echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-ok'></i>  Cadastro realizado com sucesso</div>";
                    //echo "<script>location.href='?inc=view/usuario/lista';</script>";
                }
                //Cado retorne 0 Não foi possível cadastrar
                else {
                    return ('erro');
                }
            }
            return $json;
        }//fim erro
    }

    //FIM METODO CADASTRAR
}

//FIM CLASSE CONTROLE
?>
