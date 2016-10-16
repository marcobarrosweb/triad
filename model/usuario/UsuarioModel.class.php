<?php

class UsuarioModel {

    protected $usuario_id;
    protected $nome;
    protected $email;
    protected $senha;
    protected $perfil;

    //METODOS GET E SET VARIAVEIS
    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    //FIM METODOS GET E SET
    //METODO LOGAR
    public function logar(array $dados) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();
            /* as propriedades recebem os dados vindo do formulario */
            $this->setEmail($dados['email']);
            $this->setSenha($dados['senha']);

            $sql = " SELECT * FROM usuario u WHERE
                                            u.email = '" . $this->getEmail() . "' AND
                                            u.senha = '" . $this->getSenha() . "'";
            $script = $conn->prepare($sql);
            $script->execute();
            $resultado = $script->fetchAll();
            //Fecha Conexao com o Banco de Dados
            TTransaction::close();
            return $resultado; //retorna dados
        } catch (PDOException $e) {
            //Caso ocorra alguma exceção, exibe na tela
            return "Erro: " . $e->getMessage();
        }
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
                0 => 'usuario_id',
                1 => 'nome',
                2 => 'email'
            );

            $sql = "SELECT * FROM usuario";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $totalData = count($result);
            $totalFiltered = $totalData;


            if (!empty($requestData['search']['value'])) {
                $sql .= " WHERE ( nome LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR email LIKE '" . $requestData['search']['value'] . "%' )";
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
                $nestedData[] = $row["email"];
                // if ($row["usua_habilitado"] == 1) {
                //     $nestedData[] = '<span class="label label-inverse">ATIVO</span>';
                // } else {
                //     $nestedData[] = '<span class="label label-important">INATIVO</span>';
                // }
                $nestedData[] = '<a class="btn btn-default" href="?inc=view/usuario/editar&usuario_id=' . $row['usuario_id'] . '"><i class="fa fa-pencil"></i></a> <a href="#" class="btn btn-default" id="usuarioExcluir" usuario_id="' . $row['usuario_id'] . '" ><i class="fa fa-trash-o"></i></a>';
                $data[] = $nestedData;
            }

            $totalData = count($data);

            $totalFiltered = $totalData;


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
    public function pesquisar($palavra, $palavraChave, $coluna) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            if (($palavra == NULL) && ($palavraChave == NULL) && ($coluna == NULL)) {
                $sql = "SELECT * FROM usuario u ORDER BY u.usua_codigo desc";
                $script = $conn->prepare($sql); //Prepara sql
                $script->execute(); //executa sql
                $resultado = $script->fetchAll(); //retorna os dados em um vetor
            } else if (($palavra != NULL) && ($palavraChave == NULL) && ($coluna != NULL)) {
                $sql = "SELECT * FROM usuario WHERE " . $coluna . "='" . $palavra . "'";
                $script = $conn->prepare($sql); //Prepara sql
                $script->execute(); //executa sql
                $resultado = $script->fetchAll(); //retorna os dados em um vetor
            } else if (($palavra == NULL) && ($palavraChave != NULL) && ($coluna != NULL)) {
                $sql = "SELECT * FROM usuario WHERE " . $coluna . " like '%$palavraChave%'";
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

    /* -Fim do Metodo - */

    //Inicio metodo Cadastrar
    public function cadastrar(array $dados) {
        try {

            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            /* As propriedades recebem os dados vindo do formulario */
            $this->setNome($dados['nome']);
            $this->setEmail($dados['email']);
            $this->setSenha($dados['senha']);
            $this->setPerfil($dados['perfil']);

            //Monta instrução sql
            $sql = " INSERT INTO usuario SET    nome           = '" . $this->getNome() . "',
                                                email          = '" . $this->getEmail() . "',
                                                senha          = '" . $this->getSenha() . "',
                                                perfil          = '" . $this->getPerfil() . "'";
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

    public function alterar(array $dados) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            /* As propriedades recebem os dados vindo do formulario */
            $this->setUsuario_id($dados['usuario_id']);
            $this->setNome($dados['nome']);
            $this->setEmail($dados['email']);
            $this->setSenha($dados['senha']);

            //Monta instrução sql
            $sql = " UPDATE usuario SET         nome           = '" . $this->getNome() . "',
                                                email          = '" . $this->getEmail() . "',
                                                senha          = '" . $this->getSenha() . "'
                                                WHERE usuario_id   = '" . $this->getUsuario_id() . "'";
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

    /* -Fim do Metodo - */

    //FUNÇÃO VERIFICAR VINCULO COM OUTRAS TABELAS
    public function verificaVinculo($usuario_id) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();

            $this->setUsuario_id($usuario_id);

            $sql = "SELECT * FROM usuario u, reserva r  WHERE u.usuario_id=r.fk_usuario_id AND u.usuario_id='" . $this->getUsuario_id() . "'";
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

    public function excluir(array $dados) {
        try {
            //Abre conexao com o Banco de Dados
            TTransaction::open();
            $conn = TTransaction::get();
            //
            /* Os set recebem os dados vindo do formulario */
            $this->setUsuario_id($dados["usuario_id"]);
            //Monta instrução sql
            $sql = " DELETE FROM usuario WHERE usuario_id = '" . $this->getUsuario_id() . "'";

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
