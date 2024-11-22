<?php

include "conexao.php";

$id = intval($_GET['id']);
function limpar_texto($str) {
    return preg_replace("/[^0-9]/", "", $str); 
}


if(count($_POST) > 0) {


    $erro = false;

     $nome = $_POST['nome'];
     $email = $_POST['email'];
     $telefone = $_POST['telefone'];
     $nascimento = $_POST['nascimento'];

    if(empty($nome)) {
        $erro = "Preencha o nome";
    }

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o email";
    }

    if(!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão (11)99999-9999";
        }
    }

    if(!empty($nascimento)) {
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nascimento deve seguir o padrão dia/mês/ano.";
        }
    }


    if($erro) {
        echo "<p><strong>ERRO: $erro</strong></p>";
    } else {
        $sql = "UPDATE clientes
        SET nome = '$nome',
        email = '$email',
        telefone = '$telefone',
        nascimento = '$nascimento'
        WHERE id = '$id'";

        $result = $conn->query($sql) or die($conn->error);
        if($result) {
            echo "<p><strong>Cliente atualizado com sucesso!!</strong></p>";
            unset($_POST);
        }
    }

}


$sql_select = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $conn->query($sql_select) or die($conn->error);

$cliente = $query_cliente->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/cadastro.css">
    <link rel="stylesheet" href="./style/global.css">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <a href="/clientes.php">Voltar para a lista</a>
    <form method="POST" action=""> 
    <!-- cadastro feito dentro desta página (action em branco) -->
        <div>
            <label hidden>Nome</label>
            <input type="text" name="nome" placeholder="Nome" 
            value="<?php echo $cliente['nome'] ?>">
            <!-- agora exibe o nome do cliente recuperado do banco -->
        </div>
        <div>
            <label hidden>Email</label>
            <input type="text" name="email" placeholder="E-mail"
            value="<?php echo $cliente['email'] ?>">
        </div>
        <div>
            <label hidden>Telefone</label>
            <input type="text" name="telefone" placeholder="Telefone" placeholder="(11)99999-9999"
            value="<?php if(!empty($cliente['telefone'])) echo formatar_telefone($cliente['telefone']) ?>">
        </div>
        <div>
            <label hidden>Data de Nascimento</label>
            <input value="<?php if(!empty($cliente['nascimento'])) echo formatar_data($cliente['nascimento']) ?>" type="text" name="nascimento" placeholder="Data de Nascimento">
        </div>

        <div>
            <button type="submit" name="submit">Salvar Cliente</button>
        </div>
    </form>
</body>
</html>