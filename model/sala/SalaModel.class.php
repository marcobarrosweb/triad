<?php

class SalaModel {

    protected $sala_id;
    protected $nome;
    protected $descricao;

    //METODOS GET E SET VARIAVEIS

    public function getSala_id() {
        return $this->sala_id;
    }

    public function setSala_id($sala_id) {
        $this->sala_id = $sala_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    //FIM METODOS GET E SET
    //LISTAGEM DATATABLES
    public function listagem() {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            $json_data = array();

            $requestData = $_REQUEST;
            $columns = array(
                0 => 'sala_id',
                1 => 'nome',
                2 => 'descricao'
            );

            $sql = "SELECT * FROM sala s";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $totalData = count($result);
            $totalFiltered = $totalData;


            if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql .= " WHERE ( s.sala_id LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR s.descricao LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR s.nome LIKE '%" . $requestData['search']['value'] . "%' )";
            }

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $totalFiltered = count($result);

            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            $data = array();
            foreach ($result as $row) {
                $nestedData = array();
                $nestedData[] = $row["nome"];
                $nestedData[] = $row["descricao"];
                $nestedData[] = '<a class="btn btn-default" href="?inc=view/sala/editar&sala_id=' . $row['sala_id'] . '"><i class="fa fa-pencil"></i></a> <a href="#" class="btn btn-default" id="salaExcluir" sala_id="' . $row['sala_id'] . '" ><i class="fa fa-trash-o"></i></a>';

                $data[] = $nestedData;
            }

            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );


            return($json_data);
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
        } catch (PDOException $e) {
            //caso ocorra alguma exceção, exibe na tela
            return "Erro: " . $e->getMessage();
        }
    }

    //FIM METODO DE LISTAGEN
    //FUNÇÃO PESQUISAR
    public function pesquisar($palavra, $palavraChave, $coluna) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            if (($palavra == NULL) && ($palavraChave == NULL) && ($coluna == NULL)) {
                $sql = "SELECT * FROM sala";
                $script = $conn->prepare($sql); //Prepara sql
                $script->execute(); //executa sql
                $resultado = $script->fetchAll(); //retorna os dados em um vetor
            } else if (($palavra != NULL) && ($palavraChave == NULL) && ($coluna != NULL)) {
                $sql = "SELECT * FROM sala WHERE " . $coluna . "='" . $palavra . "'";
                $script = $conn->prepare($sql); //Prepara sql
                $script->execute(); //executa sql
                $resultado = $script->fetchAll(); //retorna os dados em um vetor
            } else if (($palavra == NULL) && ($palavraChave != NULL) && ($coluna != NULL)) {
                $sql = "SELECT * FROM sala WHERE " . $coluna . " like '%$palavraChave%'";
                $script = $conn->prepare($sql); //Prepara sql
                $script->execute(); //executa sql
                $resultado = $script->fetchAll(); //retorna os dados em um vetor
            }
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
            return $resultado;
        } catch (PDOException $e) {
            //caso ocorra alguma exceção, exibe na tela
            return "Erro: " . $e->getMessage();
        }
    }

    //INICIO METODO CADASTRAR
    public function cadastrar(array $dados) {
        try {

            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            /* As propriedades recebem os dados vindo do formulario */
            $this->setNome($dados['nome']);
            $this->setDescricao($dados['descricao']);

            //Monta instrução sql
            $sql = " INSERT INTO sala SET nome  = '" . $this->getNome() . "', descricao  = '" . $this->getDescricao() . "'";
            $script = $conn->prepare($sql);
            $resultado = $script->execute();
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
            return $resultado; //retorna os dados
        } catch (PDOException $e) {
            //Caso ocorra alguma exceção, exibe na tela.
            return "Erro: " . $e->getMessage();
        }
    }

    //INICIO METODO ALTERAR
    public function alterar(array $dados) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            /* As propriedades recebem os dados vindo do formulario */
            $this->setSala_id($dados['sala_id']);
            $this->setNome($dados['nome']);
            $this->setDescricao($dados['descricao']);

            //Monta instrução sql
            $sql = " UPDATE sala SET
              nome = '" . $this->getNome() . "',
              descricao = '" . $this->getDescricao() . "'
              WHERE sala_id   = '" . $this->getSala_id() . "'";

            $script = $conn->prepare($sql);
            $resultado = $script->execute();
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
            return $resultado;
        } catch (PDOException $e) {
            //caso ocorra alguma exceção, exibe na tela
            return "Erro: " . $e->getMessage();
        }
    }

    //METODO VERIFICAR VINCULO COM OUTRAS TABELAS
    public function verificaVinculo($sala_id) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();
            //Monta instrução sql
            $sql = "SELECT * FROM sala s, reserva r  WHERE s.sala_id=r.fk_sala_id AND s.sala_id='" . $sala_id . "'";
            $script = $conn->prepare($sql); //Prepara sql
            $script->execute(); //executa sql
            $resultado = $script->fetchAll(); //retorna os dados em um vetor
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
            return $resultado;
        } catch (PDOException $e) {
            //caso ocorra alguma exceção, exibe na tela
            return "Erro: " . $e->getMessage();
        }
    }

    //METODO EXCLUIR
    public function excluir(array $dados) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();
            $this->setSala_id($dados["sala_id"]);
            //Monta instrução sql
            $sql = " DELETE FROM sala WHERE sala_id = '" . $this->getSala_id() . "'";
            $script = $conn->prepare($sql);
            $resultado = $script->execute();
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
            return $resultado; //retorna os dados
        } catch (PDOException $e) {
            //caso ocorra alguma exceÇÃo, exibe na tela
            return "Erro: " . $e->getMessage();
        }
    }

}

//  Fim da classe
