<?php
include('conexao.php');

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql) or die($conn->error);

$num_clientes = $result->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/global.css">
    <title>Lista de Clientes</title>
</head>

<body>
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data de Cadastro</th>
            <th></th>
        </thead>
        <tbody>
            <?php if ($num_clientes == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum cliente cadastrado</td>
                </tr>
            <?php } else { 
                while($cliente = $result->fetch_assoc()) {    
                    $telefone = "Não informado";
                    if(!empty($cliente['telefone'])) {
                        $telefone = formatar_telefone($cliente['telefone']);
                    }
                    $nascimento = "Não informado";
                    if(!empty($cliente['nascimento'])) {
                        $nascimento = formatar_data($cliente['nascimento']);
                    }
                    $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro'])); // strtotime transforma a data em timestamp e funciona apenas com data no formato estrangeiro 
            ?>
                <tr>
                    <td><?php echo $cliente['id']?></td>
                    <td><?php echo $cliente['nome']?></td>
                    <td><?php echo $cliente['email']?></td>
                    <td><?php echo $telefone?></td>
                    <td><?php echo $nascimento?></td>
                    <td><?php echo $data_cadastro?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $cliente['id']?>">Editar</a>
                        <a href="deletar_cliente.php?id=<?php echo $cliente['id']?>">Deletar</a>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>

</body>

</html>