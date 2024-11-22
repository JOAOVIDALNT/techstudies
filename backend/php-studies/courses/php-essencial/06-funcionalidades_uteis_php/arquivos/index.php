<?php

include 'conexao.php';

if(isset($_GET['deletar'])) {

    $id = intval($_GET['deletar']);
    $sql = $conn->query("SELECT * FROM arquivos WHERE id = '$id'") or die($conn->error);
    $arquivo = $sql->fetch_assoc();

    if(unlink($arquivo['path'])) {
        $result = $conn->query("DELETE FROM arquivos WHERE id = '$id'") or die($conn->error);
        if($result)
            echo "<p>Arquivo excluido com sucesso!</p>";
    }

}


function enviarArquivo($error, $size, $name, $tmp_name)
{   
    include 'conexao.php';
    if ($error)
        die("Falha ao enviar arquivo");
    
    if ($size > 2097152)
        die("Arquivo muito grande, máximo 2MB");

    $pasta = "files/";
    $nomeArquivo = $name;
    $novoNomeArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION)); // busca info da extensão do endereço

    if ($extensao != "jpg" && $extensao != "png") {
        die("Tipo de arquivo não aceito");
    }

    $path = $pasta . $novoNomeArquivo . "." . $extensao;
    $result = move_uploaded_file($tmp_name, $path); // retorna true se der certo

    if ($result) {
        $conn->query("INSERT INTO arquivos (nome_original, path) VALUES ('$nomeArquivo', '$path')") or die($conn->error);
        return true;
    } else {
        return false;
    }
}

if (isset($_FILES['arquivos'])) {

    $arquivos = $_FILES['arquivos'];
    $tudo_certo = true;

    foreach($arquivos['name'] as $index => $arq) {
        $result = enviarArquivo($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index]);

        if(!$result)
            $tudo_certo = false;
    }
    if($tudo_certo)
        echo "<p>Todos os arquivos foram enviados com sucesso!";
    else
        echo "<p>Falha ao enviar um ou mais arquivos</p>";


}

$sql = $conn->query("SELECT * FROM arquivos") or die($conn->error);

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
    <form method="POST" enctype="multipart/form-data" action=""> <!-- o enctype define que podemos enviar arquivos -->
        <label for="">Selecione o arquivo</label>
        <input multiple name="arquivos[]" type="file">
        <br>
        <button name="upload" type="submit">Enviar arquivo</button>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <th>Preview</th>
            <th>Arquivo</th>
            <th>Data de envio</th>
            <th></th>
        </thead>
        <tbody>
        <?php
while ($arquivo = $sql->fetch_assoc()) {
    ?>
            <tr>
                <td><img height="50" src="<?php echo $arquivo['path'] ?>"></td>
                <td><a target="_blank" href="<?php echo $arquivo['path'] ?>"> <?php echo $arquivo['nome_original']; ?></a></td>
                <td><?php echo date("d/m/Y H:i", strtotime($arquivo['data_upload'])); ?></td>
                <td><a href="index.php?deletar=<?php echo $arquivo['id'] ?>">Deletar</td>
            </tr>
        <?php
}
?>
        </tbody>
    </table>

</body>
</html>