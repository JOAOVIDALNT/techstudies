<?php

$address = 'localhost';
$db = 'teste-product';
$user = 'postgres';
$password = 'root';


try {
    $pdo = new PDO("pgsql:host=$address;port=5432;dbname=$db",
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT SUBSTRING(pm.data_integracao::text, 0, 8) AS data, SUM(pd.quant::numeric) AS quantidade, pd.produto
            FROM pedido_detalhe_produto_integracao_bling pd
            INNER JOIN pedido_master_produto_integracao_bling pm ON pd.pedido_integracao = pm.pedido_integracao
            GROUP BY SUBSTRING(pm.data_integracao::text, 0, 8), pd.produto
            LIMIT 10";

    $result = array();

    foreach ($pdo->query($sql) as $row) {

        $obj = new stdClass();
        $obj->data = $row['data'];
        $obj->quantidade = $row['quantidade'];
        $obj->produto = $row['produto'];


        $result[] = $obj;
    }

    return $result;

} catch (PDOException $e) {
    die($e->getMessage());
}
