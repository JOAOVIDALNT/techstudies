<?php
if (isset($_POST['email'])) {

    include('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM senhas WHERE email = '$email'";
    $result = $conn->query($sql) or die($conn->error);

    $usuario = $result->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        if(!isset($_SESSION))
            session_start();

        $_SESSION['usuario'] = $usuario['id']; // -> identifica o usuário através do id no banco
        header("Location: index.php");
    } else {
        echo "Falha ao logar, senha ou email incorretos";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <p>
            <label for="email">Email</label>
            <input type="text" name="email"><br>
        </p>
        <p>
            <label for="senha">Senha</label>
            <input type="password" name="senha"><br>
        </p>
        <button type="submit">Logar</button>
    </form>
</body>

</html>