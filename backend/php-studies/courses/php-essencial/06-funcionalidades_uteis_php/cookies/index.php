<?php 
if(isset($_POST['nome'])) {
    // echo "Bem vindo, " . $_POST['nome'];

    // COM O COOKIE PODEMOS GUARDAR INFOS DO USUÁRIO PARA QUE AO ATUALIZAR NÃO HAJA PERDA
    $vencimento = time() + (30 * 24 * 60 * 60); // 30 DIAS
    setcookie("nome", $_POST['nome'], $vencimento); // PARAMS: nome do cookie, valor do cookie e data de expiração do cookie
    header("Location: boasvindas.php"); // Redireciona pois o formulário atualiza antes do cookie
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
        <p>Qual é o seu nome? </p>
        <input type="text" name="nome">
        <button type="submit">Salvar</button>
    </form>
</body>
</html>