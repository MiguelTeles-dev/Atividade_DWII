
<?php

include_once __DIR__ . "/BoletoDAO.php";

class PDOBoletoDAO extends BoletoDAO
{
    private static $instance = NULL;
    private $conn = NULL;

    function PDOBoletoDAO()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == NULL) {
            self::$instance = new PDOBoletoDAO();
        }

        return self::$instance;
    }

    /**
     * Método que faz a conexão com o banco de dados.
     */
    function connect()
    {
        try {
            $this->conn = new PDO(
                'sqlite:' . __DIR__ . '/pessoas.db'
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    /**
     * Método que insere dados de um boleto.
     */
    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare(
                'INSERT INTO boleto (
                    data_vencimento,
                    data_emissao,
                    data_pagamento,
                    valor,
                    desconto,
                    juros,
                    multa,
                    mora,
                    valor_pago
                ) VALUES (
                    :data_vencimento,
                    :data_emissao,
                    :data_pagamento,
                    :valor,
                    :desconto,
                    :juros,
                    :multa,
                    :mora,
                    :valor_pago
                )'
            );

            $stmt->execute(array(
                ':data_vencimento' => $objeto->data_vencimento,
                ':data_emissao' => $objeto->data_emissao,
                ':data_pagamento' => $objeto->data_pagamento,
                ':valor' => $objeto->valor,
                ':desconto' => $objeto->desconto,
                ':juros' => $objeto->juros,
                ':multa' => $objeto->multa,
                ':mora' => $objeto->mora,
                ':valor_pago' => $objeto->valor_pago
            ));

            print $stmt->rowCount();

        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Método que altera dados de um boleto.
     */
    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare(
                'UPDATE boleto SET
                    data_vencimento = :data_vencimento,
                    data_emissao = :data_emissao,
                    data_pagamento = :data_pagamento,
                    valor = :valor,
                    desconto = :desconto,
                    juros = :juros,
                    multa = :multa,
                    mora = :mora,
                    valor_pago = :valor_pago
                WHERE id = :id'
            );

            $stmt->execute(array(
                ':data_vencimento' => $objeto->data_vencimento,
                ':data_emissao' => $objeto->data_emissao,
                ':data_pagamento' => $objeto->data_pagamento,
                ':valor' => $objeto->valor,
                ':desconto' => $objeto->desconto,
                ':juros' => $objeto->juros,
                ':multa' => $objeto->multa,
                ':mora' => $objeto->mora,
                ':valor_pago' => $objeto->valor_pago,
                ':id' => $objeto->id
            ));

            print $stmt->rowCount();

        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Método que exclui um boleto.
     */
    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare(
                'DELETE FROM boleto WHERE id = :id'
            );

            $stmt->execute(array(
                ':id' => $id
            ));

            print $stmt->rowCount();

        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Método que lista os boletos.
     */
    function listar()
    {
        $dados = array();

        try {
            $result = $this->conn->query(
                "SELECT * FROM boleto"
            );

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $boleto = array();

                $boleto['id'] = $linha['id'];
                $boleto['data_vencimento'] = $linha['data_vencimento'];
                $boleto['data_emissao'] = $linha['data_emissao'];
                $boleto['data_pagamento'] = $linha['data_pagamento'];
                $boleto['valor'] = $linha['valor'];
                $boleto['desconto'] = $linha['desconto'];
                $boleto['juros'] = $linha['juros'];
                $boleto['multa'] = $linha['multa'];
                $boleto['mora'] = $linha['mora'];
                $boleto['valor_pago'] = $linha['valor_pago'];

                array_push($dados, $boleto);
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return $dados;
    }

    /**
     * Método que lista boletos com filtro.
     */
    function listar_filtro($filtro)
    {
        $dados = array();

        try {
            $result = $this->conn->query(
                "SELECT * FROM boleto " . $filtro
            );

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $boleto = array();

                $boleto['id'] = $linha['id'];
                $boleto['data_vencimento'] = $linha['data_vencimento'];
                $boleto['data_emissao'] = $linha['data_emissao'];
                $boleto['data_pagamento'] = $linha['data_pagamento'];
                $boleto['valor'] = $linha['valor'];
                $boleto['desconto'] = $linha['desconto'];
                $boleto['juros'] = $linha['juros'];
                $boleto['multa'] = $linha['multa'];
                $boleto['mora'] = $linha['mora'];
                $boleto['valor_pago'] = $linha['valor_pago'];

                array_push($dados, $boleto);
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return $dados;
    }

    /**
     * Método que obtém um boleto pelo ID.
     */
    function obter($id)
    {
        $boleto = array();

        try {
            $stmt = $this->conn->prepare(
                'SELECT * FROM boleto WHERE id = :id'
            );

            $stmt->execute(array(
                ':id' => $id
            ));

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $boleto['id'] = $linha['id'];
                $boleto['data_vencimento'] = $linha['data_vencimento'];
                $boleto['data_emissao'] = $linha['data_emissao'];
                $boleto['data_pagamento'] = $linha['data_pagamento'];
                $boleto['valor'] = $linha['valor'];
                $boleto['desconto'] = $linha['desconto'];
                $boleto['juros'] = $linha['juros'];
                $boleto['multa'] = $linha['multa'];
                $boleto['mora'] = $linha['mora'];
                $boleto['valor_pago'] = $linha['valor_pago'];
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return $boleto;
    }
}
?>
