<?php

class ReservaControl {

    //INICIO METODO PESQUISA
    public function pesquisar($palavra, $palavraChave, $coluna) {
        $ProdutoModel = new ProdutoModel(); //CRIA OBJETO MODELO
        $resultado = $ProdutoModel->Pesquisar($palavra, $palavraChave, $coluna); //CHAMADA METODO PESQUISAR
        return ($resultado);
    }

    //INICIO METODO EXCLUIR
    public function excluir() {
        $reservaModel = new ReservaModel(); //CRIA OBJETO MODELO
        $dados = $_POST; //REPASSA O prod_codigo
        $resultado = $reservaModel->excluir($dados); //CHAMADA METODO EXCLUIR com o prod_codigo
        //VERIFICAR VINCULO COM A TABELA DE PRODUTOS

        if (sizeof($resultado) == 1) { //caso retorne 1 Exclusão realizada com sucesso
            return ('exclusao');
        } else { //caso retorne 0 Não foi possível excluir
            return ('erro');
        }
    }

    /*
      Retorna true ou false comparando a maior hora
      Parametros hora_inicio 00:00 hora_final 00:00
     */

    public function maiorHora($hora_inicio, $hora_fim) {
        // Separa á hora dos minutos
        $hIni = explode(':', $hora_inicio);
        $hFinal = explode(':', $hora_fim);

        // Converte a hora e minuto para segundos
        $hIni = (60 * 60 * $hIni[0]) + (60 * $hIni[1]);
        $hFinal = (60 * 60 * $hFinal[0]) + (60 * $hFinal[1]);

        // Verifica se a hora final é maior que a inicial
        if (!($hIni < $hFinal)) {
            return true;
        } else {
            return false;
        }
    }

    //INICIO METODO CADASTRAR
    public function cadastrar() {
        $dados = $_POST;
        $erros = 0; //Variável de erro
        $msg = ""; //Variável mensagem
        //Tratamento dos erros que podem ocorrer como: campo em branco entre outros.

        if ($dados["sala_id"] == " " || $dados["sala_id"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Sala: </strong> não selecionada.</span></div>";
        }
        if ($dados["data_inicio"] == "" || $dados["data_inicio"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Data Inicial: </strong> não informada.</span></div>";
        }
        if ($dados["hora_inicio"] == "" || $dados["hora_inicio"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Hora Inicial: </strong> não informada.</span></div>";
        }
        if ($dados["data_fim"] == "" || $dados["data_fim"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Data final: </strong> não informada.</span></div>";
        }
        if ($dados["hora_fim"] == "" || $dados["hora_fim"] == NULL) {
            $erros++;
            $msg .= "<div><span><strong>Hora final: </strong> não informada.</span></div>";
        }

        if ($dados["data_inicio"] != "" && $dados["data_fim"] != "" && $dados["hora_inicio"] != "" && $dados["hora_fim"] != "") {
            if ($dados["data_inicio"] == $dados["data_fim"] && $this->maiorHora($dados["hora_inicio"], $dados["hora_fim"])) {
                $erros++;
                $msg .= "<div><span><strong>Verificar as horas: </strong>informadas.</span></div>";
            }
        }


        //Se existir Erro exibe mensagem
        if ($erros > 0) {
            return("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>×</button><strong>ATENÇÃO</strong>" . $msg . "</div></div>");
        }//fim
        //Caso não exista Erro no formulario
        else {
            $reservaModel = new ReservaModel(); //CRIA OBJETO MODELO
            //Formata data consulta no banco
            $arrayDataInicio = explode("/", $dados['data_inicio']);
            $dados['data_inicio'] = $arrayDataInicio[2] . "-" . $arrayDataInicio[1] . "-" . $arrayDataInicio[0] . " " . $dados['hora_inicio'];
            $arrayDataFim = explode("/", $dados['data_fim']);
            $dados['data_fim'] = $arrayDataFim[2] . "-" . $arrayDataFim[1] . "-" . $arrayDataFim[0] . " " . $dados['hora_fim'];

            //Verifica disponibilidade de data e horario de Reserva
            $resultadoExistencia = $reservaModel->verifica_disponibilidade($dados["sala_id"], $dados["data_inicio"], $dados["data_fim"]); //Verifica se usuário já cadastrado.

            if (sizeof($resultadoExistencia) > 0) {//Verifica a quatidade de linhas atigidas na consulta
                return ('existencia');
            }
            if (sizeof($resultadoExistencia) == 0) {//Caso retorne  0  procegue o cadastro.
                //PREPARA DADOS PARA BANCO
                $dados['usuario_id'] = $_SESSION['usuario_id'];

                $resultadoCadastro = $reservaModel->cadastrar($dados); //Aciona o metodo cadastrar do modelo.
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
}

//FIM CLASSE CONTROLE
?>
