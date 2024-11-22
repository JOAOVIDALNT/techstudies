<?php 
include('conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario']))
    die('Você não está logado. <a href="login.php">Clique aqui</a> para logar');

if(isset($_POST['email'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO senhas (nome, email, senha) VALUES('$nome','$email','$senha')");
}
// JÁ SABEMOS QUE EXISTE SESSÃO, POIS A APLICAÇÃO NÃO MORREU, ENTÃO VAMOS PEGAR DADOS DO BANCO, PARA POR EXEMPLO, EXIBIR O NOME DO USUÁRIO
$id = $_SESSION['usuario'];
$sql = $conn->query("SELECT * FROM senhas WHERE id = '$id'") or die($conn->error);
$usuario = $sql->fetch_assoc();


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
    <p>Bem vindo, <?php echo $usuario['nome']?></p>
        <h1>Cadastro de usuário</h1>
        <p>
            <label for="nome">Nome</label>
            <input type="text" name="nome"><br>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email"><br>
        </p>
        <p>
            <label for="senha">Senha</label>
            <input type="password" name="senha"><br>
        </p>
        <button type="submit">Cadastrar senha</button>
    </form>
    <p><a href="logout.php">Sair</a></p>
    
</body>
</html>