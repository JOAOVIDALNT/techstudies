<?php
if (isset($_POST['confirmar'])) {
    include 'conexao.php';
    $id = intval($_GET['id']);
    $sql = "DELETE FROM clientes WHERE id = '$id'";
    $result = $conn->query($sql) or die($conn->error);

    if($result) { ?>
        <h1>Cliente deletado com sucesso!</h1>
        <p><a href="clientes.php">Clique aqui para voltar para a lista de clientes</a></p>
        <?php
        die(); // para que não seja exibido a confirmação de deleção
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar cliente</title>
</head>
<body>
    <h1>Tem certeza que deseja deletar esse cliente?</h1>
    <form action="" method="POST">
        <a href="clientes.php">Não</a>
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
    
</body>
</html>