
<?php

// $_GET nada mais é do que um array, inicialmente vazio.
echo $_GET['Nome'] . PHP_EOL;
// Caso sejam passados valores via URL esta ação irá exibir o nome em questão. Exemplo
// localhost/php/php-studies/courses/php-essencial/03-formularios/noticia.php?Nome=Joao&&Idade=25
// RETORNA: Joao

var_dump($_GET);
// Se dermos var_dump em um $_GET antes de passar algum valor via url veremos que ele é um array vazio
// Assim que passamos dados via query params esse array recebe esses valores, todos como string
?>

<p>O nome é: <?php echo $_GET['Nome'] ?></p>
<p>A idade é: <?php echo $_GET['Idade'] ?></p>

<!-- 
RETORNO: 
O nome é: João
A idade é: 23
 -->

