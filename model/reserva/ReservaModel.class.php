<?php

class ReservaModel {

    protected $reserva_id;
    protected $fk_sala_id;
    protected $fk_usuario_id;
    protected $data_inicio;
    protected $data_fim;

    //METODOS GET E SET VARIAVEIS
    function getReserva_id() {
        return $this->reserva_id;
    }

    function getFk_sala_id() {
        return $this->fk_sala_id;
    }

    function getFk_usuario_id() {
        return $this->fk_usuario_id;
    }

    function getData_inicio() {
        return $this->data_inicio;
    }

    function getData_fim() {
        return $this->data_fim;
    }

    function setReserva_id($reserva_id) {
        $this->reserva_id = $reserva_id;
    }

    function setFk_sala_id($fk_sala_id) {
        $this->fk_sala_id = $fk_sala_id;
    }

    function setFk_usuario_id($fk_usuario_id) {
        $this->fk_usuario_id = $fk_usuario_id;
    }

    function setData_inicio($data_inicio) {
        $this->data_inicio = $data_inicio;
    }

    function setData_fim($data_fim) {
        $this->data_fim = $data_fim;
    }


    //FIM METODOS GET E SET

    function formata_data_br($data) {
        //quebrar a data em dia mes e ano
        $ano = substr($data, 0, 4);
        $mes = substr($data, 5, 2);
        $dia = substr($data, 8, 2);
        $hora = substr($data, 10, 6);
        //concatenar data no formato (0000-00-00)
        $data = $dia . '/' . $mes . '/' . $ano . " " . $hora;
        return $data;
    }

    //LISTAGEM DATATABLES
    public function listagem() {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            $json_data = array();
            $requestData = $_REQUEST;
            $columns = array(
                0 => 'reserva_id',
                1 => 'fk_sala_id',
                2 => 'fk_usuario_id',
                3 => 'data_inicio',
                4 => 'data_fim'
            );

            $sql = "SELECT r.*, s.*, s.nome as sala_nome, u.*, u.nome as usuario_nome FROM
            reserva r, sala s, usuario u
            WHERE r.fk_sala_id = s.sala_id AND r.fk_usuario_id = u.usuario_id ";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $totalData = count($result);
            $totalFiltered = $totalData;


            if (!empty($requestData['search']['value'])) {
                $sql.=" AND ( u.nome LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql.=" OR s.nome LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql.=" OR u.email LIKE '" . $requestData['search']['value'] . "%' )";
            }

            $sql.="ORDER BY r.data_inicio desc";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $totalFiltered = count($result);

            //$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            $data = array();
            foreach ($result as $row) {
                $nestedData = array();
                $nestedData[] = $row["sala_nome"];
                $nestedData[] = $this->formata_data_br($row["data_inicio"]) . " à " . $this->formata_data_br($row["data_fim"]);
                $nestedData[] = $row["usuario_nome"] . " - " . $row["email"];
                $nestedData[] = '<a class="btn btn-primary" href="?inc=view/produto/editar&codigo=' . $row['prod_codigo'] . '"><i class="fa fa-pencil"></i></a><a href="#" class="btn btn-danger" id="produtoExcluir" prod_codigo="' . $row['prod_codigo'] . '" ><i class="fa fa-trash-o"></i></a>';

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

    //FUNÇÃO PESQUISAR
    public function verifica_disponibilidade($sala_id, $data_inicio, $data_fim) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            $this->setFk_sala_id($sala_id);
            $this->setData_inicio($data_inicio);
            $this->setData_fim($data_fim);

            $sql = "SELECT * FROM reserva r WHERE
                 (
                  (r.data_inicio BETWEEN '" . $this->getData_inicio() . "' AND '" . $this->getData_fim() . "') OR
                  (r.data_fim    BETWEEN '" . $this->getData_inicio() . "' AND '" . $this->getData_fim() . "') OR
                  ('" . $this->getData_inicio() . "' BETWEEN r.data_inicio AND r.data_fim) OR
                  ('" . $this->getData_fim() . "' BETWEEN r.data_inicio AND r.data_fim)
                ) AND r.fk_sala_id = '" . $this->getFk_sala_id() . "'";

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

    /* -Fim do Metodo - */

    //Inicio metodo Cadastrar
    public function cadastrar(array $dados) {
        try {

            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            /* As propriedades recebem os dados vindo do formulario */
            $this->setFk_sala_id($dados['sala_id']);
            $this->setFk_usuario_id($dados['usuario_id']);
            $this->setData_inicio($dados['data_inicio']);
            $this->setData_fim($dados['data_fim']);

            //Monta instrução sql
            $sql = " INSERT INTO reserva SET    fk_sala_id      = '" . $this->getFk_sala_id() . "',
                                                fk_usuario_id   = '" . $this->getFk_usuario_id() . "',
                                                data_inicio     = '" . $this->getData_inicio() . "',
                                                data_fim        = '" . $this->getData_fim() . "'";
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

    /* -Fim do Metodo Cadastrar - */
}

//  Fim da classe
