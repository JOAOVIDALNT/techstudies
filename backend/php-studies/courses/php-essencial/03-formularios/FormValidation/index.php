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
        <input name="nome" type="text" placeholder="Nome"> <br><br>
        <input name="email" type="text" placeholder="E-mail"> <br><br>
        <input name="website" type="text" placeholder="WebSite"> <br><br>
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

                if(empty($_POST['nome']) || strlen($_POST['nome']) < 3 || strlen($_POST['nome']) > 100) {
                    echo '<p class="error">Preencha o campo nome </p>';
                    die(); // mata a execução do script (cuidado) pois se ouver mais algum código html para ser exibido ele não será, use o else para validar se for o caso
                }
                if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    echo '<p class="error">Preencha o campo e-mail </p>';
                    die();
                }
                if(!empty($_POST['website']) && !filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
                    // Site não é obrigatório, por isso só verificamos se ele não for vazio !empty
                    // filter validate também retorna bool, por isso:
                    // Se website não for vazio e o valor não for válido retornaremos o erro:
                        echo '<p class="error">Preencha corretamente o campo website </p>';
                        die();
                }



                $genero = "Não selecionado";

                if (isset($_POST['genero'])) {
                    $genero = $_POST['genero'];

                    if ($genero != "masculino" && $genero != "feminino" && $genero != "outro") {
                        echo "<p class='error'>Preencha corretamente o campo gênero</p>";
                        die();
                        // Caso o usuário tente alterar o valor de gênero pelo inspecionar essa validação não permitira
                    }
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