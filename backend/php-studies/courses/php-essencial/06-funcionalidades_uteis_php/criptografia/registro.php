<?php
if (isset($_POST['email'])) {
    include('conexao.php');

    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO senhas (email, senha) VALUES('$email','$senha')");
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
    <form action="" method="POST">
        <h1>Cadastro de senha</h1>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email"><br>
        </p>
        <p>
            <label for="senha"></label>
            <input type="password" name="senha"><br>
        </p>
        <button type="submit">Cadastrar senha</button>
    </form>

</body>

</html>