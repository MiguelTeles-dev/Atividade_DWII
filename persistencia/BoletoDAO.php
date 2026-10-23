
<?php
/**
 * Classe abstrata para persistência de Boleto
 *
 * @author Wesley R. Bezerra
 * @version 0.1
 */
abstract class BoletoDAO
{
    /**
     * Método que faz a conexão com o recurso usado
     * @return void
     */
    public abstract function connect();

    /**
     * Método que insere dados no sistema de persistência
     * @param $objeto Boleto objeto que será inserido
     * @return void
     */
    public abstract function inserir($objeto);

    /**
     * Método que altera dados no sistema de persistência
     * @param $objeto Boleto objeto que será alterado
     * @return void
     */
    public abstract function alterar($objeto);

    /**
     * Método que exclui dados no sistema de persistência
     * @param $id identificador do registro
     * @return void
     */
    public abstract function excluir($id);

    /**
     * Método que lista dados no sistema de persistência
     * @return array lista de boletos
     */
    public abstract function listar();

    /**
     * Método que lista dados com filtro
     * @param $filtro filtro para os dados
     * @return array lista de boletos filtrados
     */
    public abstract function listar_filtro($filtro);

    /**
     * Método que obtém dados do sistema de persistência
     * @param $id identificador do registro
     * @return array dados do boleto
     */
    public abstract function obter($id);
}
?>
