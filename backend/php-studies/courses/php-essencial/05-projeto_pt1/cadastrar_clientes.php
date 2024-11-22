<?php

function limpar_texto($str) {
    return preg_replace("/[^0-9]/", "", $str); 
}


if(count($_POST) > 0) {


    include "conexao.php";
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
        $sql = "INSERT INTO clientes (nome, email, telefone, nascimento, data_cadastro) 
        VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";

        $result = $conn->query($sql) or die($conn->error);
        if($result) {
            echo "<p><strong>Cliente cadastrado com sucesso!!</strong></p>";
            unset($_POST);
        }
    }

}
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
            value="<?php if(isset($_POST['nome'])) echo $_POST['nome'] ?>">
            <!-- define que se o nome estiver setado o campo mantem o valor inserido caso ocorra algum erro -->
        </div>
        <div>
            <label hidden>Email</label>
            <input type="text" name="email" placeholder="E-mail"
            value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>">
        </div>
        <div>
            <label hidden>Telefone</label>
            <input type="text" name="telefone" placeholder="Telefone" placeholder="(11)99999-9999"
            value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'] ?>">
        </div>
        <div>
            <label hidden>Data de Nascimento</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'] ?>" type="text" name="nascimento" placeholder="Data de Nascimento">
        </div>

        <div>
            <button type="submit" name="submit">Salvar Cliente</button>
        </div>
    </form>
</body>
</html>