<?php

class SalaControl {

    //INICIO METODO PESQUISA
    public function pesquisar($palavra, $palavraChave, $coluna) {
        $salaModel = new SalaModel(); //CRIA OBJETO MODELO
        $resultado = $salaModel->Pesquisar($palavra, $palavraChave, $coluna); //CHAMADA METODO PESQUISAR
        return ($resultado);
    }

    //VERIFICAR EXISTECIA DE VINCULOS COM OUTRAS TABELAS
    public function verificaVinculo($sala_id) {
        $salaModel = new SalaModel(); //CRIA OBJETO MODELO
        $resultado = $salaModel->verificaVinculo($sala_id); //CHAMADA METODO PESQUISAR
        return ($resultado);
    }

    //INIIO METODO EXCLUIR
    public function excluir() {
        $salaModel = new SalaModel(); //CRIA OBJETO MODELO
        $dados = $_POST; //REPASSA O usua_codigo
        //VERIFICAR VINCULO COM A TABELA DE PRODUTOS
        $resultadoVinculo = $this->verificaVinculo($dados['sala_id']);
        if (sizeof($resultadoVinculo) == 0) { //caso retorne 0 proseguir com a Exclusao
            $resultado = $salaModel->excluir($dados); //CHAMADA METODO EXCLUIR com o usua_codigo
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

        if ($dados["descricao"] == " " || $dados["descricao"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Descricao: </strong> não informada.</span></div>";
        }

        //Se existir Erro exibe mensagem
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //Caso não exista Erro no formulario
        else {
            $salaModel = new SalaModel(); //CRIA OBJETO MODELO
            $resultadoExistencia = $salaModel->pesquisar($dados["nome"], NULL, "nome"); //Verifica se usuário já cadastrado.
            if (sizeof($resultadoExistencia) > 0) {//Verifica a quatidade de linhas atigidas na consulta
                //echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><i class='icon-warning-sign'></i>  Usuário já cadastrado.</div>";
                return ('existencia');
            }
            if (sizeof($resultadoExistencia) == 0) {//Caso retorne  0  procegue o cadastro.
                $resultadoCadastro = $salaModel->cadastrar($dados); //Aciona o metodo cadastrar do modelo.
                //Caso retorne 1 cadastro com sucesso
                if (sizeof($resultadoCadastro) == 1) {
                    return ('sucesso');
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

        //se erro for maior que 0 exibe a mensagem
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //caso contrário sem erro
        else {
            $salaModel = new SalaModel(); //CRIA OBJETO MODELO
            $resultado = $salaModel->alterar($dados);
            if (sizeof($resultado) > 0) {//caso retorne  0  procegue o cadastro
                return('sucesso');
            } else {
                return('erro');
            }
        }
    }

//FIM METODO CADASTRAR
}

//FIM CLASSE CONTROLE
?>
