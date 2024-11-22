<?php 
if(isset($_POST['email'])) {

    include('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM senhas WHERE email = '$email'";
    $result = $conn->query($sql) or die($conn->error);

    $usuario = $result->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])) {
        echo "Usuário logado!";
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
        <input type="text" name="email"><br>
        <input type="password" name="senha"><br>
        <button type="submit">Logar</button>
    </form>
</body>
</html>