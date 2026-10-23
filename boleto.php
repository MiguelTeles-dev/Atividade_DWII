
<?php
/**
 * Código de exemplo da utilização de PDO como persistência
 * Classe Boleto
 *
 * @author Wesley R. Bezerra
 * @version 0.1
 */
class Boleto
{
    public $id;
    public $data_vencimento;
    public $data_emissao;
    public $data_pagamento;
    public $valor;
    public $desconto;
    public $juros;
    public $multa;
    public $mora;
    public $valor_pago;

    public function __construct()
    {
    }
}
?>
