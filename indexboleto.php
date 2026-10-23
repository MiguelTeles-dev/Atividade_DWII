
<?php
/**
 * Código de exemplo da utilização de PDO como persistência
 * Página responsável pela listagem da entidade Boleto
 * @author Wesley R. Bezerra
 * @version 0.1
 */
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>

<body>
    <main class="container">
        <?php include 'menu_boleto.php'; ?>

        <?php
        require_once 'persistencia/PDOBoletoDAO.php';

        $dao = PDOBoletoDAO::getInstance();
        $dados = $dao->listar();

        if (($dados == null) || (count($dados) == 0)) {
            echo "<div><span class='warning'>Sem boletos a serem exibidos</span></div>";
        }
        ?>

        <table role="grid">
            <tr>
                <th>Id</th>
                <th>Data de Vencimento</th>
                <th>Data de Emissão</th>
                <th>Data de Pagamento</th>
                <th>Valor</th>
                <th>Desconto</th>
                <th>Juros</th>
                <th>Multa</th>
                <th>Mora</th>
                <th>Valor Pago</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>

            <?php
            foreach ($dados as $key) {
                echo "<tr>
                    <td>{$key['id']}</td>
                    <td>{$key['data_vencimento']}</td>
                    <td>{$key['data_emissao']}</td>
                    <td>{$key['data_pagamento']}</td>
                    <td>{$key['valor']}</td>
                    <td>{$key['desconto']}</td>
                    <td>{$key['juros']}</td>
                    <td>{$key['multa']}</td>
                    <td>{$key['mora']}</td>
                    <td>{$key['valor_pago']}</td>
                    <td align='center'>
                        <a role='button' href='boleto.php?id={$key['id']}'>A</a>
                    </td>
                    <td align='center'>
                        <a role='button' href=\"javascript:excluirRegistro('boleto_acao.php?acao=excluir&id={$key['id']}')\">E</a>
                    </td>
                </tr>";
            }
            ?>
        </table>

        <p>
            <a role="button" href="boleto.php">Cadastrar boleto</a>
        </p>
    </main>

    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar exclusão?")) {
                location.href = url;
            }
        }
    </script>
</body>
</html>
