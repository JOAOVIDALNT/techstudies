<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h1>Formulário com PHP </h1>
        <!-- a tag required não permite que o usuario envie o formulário sem preencher o campo -->
        <!-- funciona apenas dentro de form e se existir um botão type submit  -->
        <input required name="nome" type="text" placeholder="Nome"> <br><br>
        <input required name="email" type="email" placeholder="E-mail"> <br><br>
        <input name="website" type="url" placeholder="WebSite"> <br><br>
        <textarea name="comentario" cols="30" rows="10" placeholder="Comentário"></textarea><br><br>
        Gênero: <input type="radio" value="masculino" name="genero"> Masculino
        <input type="radio" value="feminino" name="genero"> Feminino
        <input type="radio" value="outro" name="genero"> Outro <br><br>
        <!-- inputs radio com o mesmo name entram no padrão de seleção única -->
        <!-- o post vai retornar o value do input -->
        <button name="enviado" type="submit"> Enviar </button>
        <h1>Dados enviados:</h1>
        <?php
            if(isset($_POST['enviado'])) {

                $genero = "Não selecionado";

                if (isset($_POST['genero'])) {
                    $genero = $_POST['genero'];
                }

                echo "<p> Nome: " . $_POST['nome'] . "</p>";
                echo "<p> Email: " . $_POST['email'] . "</p>";
                echo "<p> Website: " . $_POST['website'] . "</p>";
                echo "<p> Comentário: " . $_POST['comentario'] . "</p>";
                echo "<p> Gênero: " . $genero . "</p>";
            }
        ?>

    </form>
    
</body>
</html>