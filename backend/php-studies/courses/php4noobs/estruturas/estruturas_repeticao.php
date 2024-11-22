<?php
// ESTRUTURAS DE REPETIÇÃO
// FOR E WHILE SÃO IDÊNTICOS A OUTRAS LINGUAGENS, O FOREACH TEM ALGUMAS RESSALVAS:
// O PHP TAMBÉM POSSUI A FUNÇÃO CONTINUE CONFIRA DEPOIS DO FOREACH:

/** REPETIÇÃO: FOREACH
 * O laço de repetição foreach é usado para iterar arrays ou objetos. O foreach funciona passando por 
 * cada elemento do array e atribuindo à ele variáveis do escopo da estrutura, para uma melhor 
 * manipulação dos elementos.
 *
 * O foreach acontece enquanto houver iteráveis dentro do array e pode parar com a condição break, 
 * caso 
 * não, ele continua até o final do array.
 *
 * A estrutura do foreach leva dois ou três parâmetros para ser iterado, com a possiblidade de não 
 * declarar o valor do índice. Entenda abaixo:
 */
echo "ITERAÇÃO FOREACH SEM INDICE\n";
$names = ["João", "Giulia", "Ana", "Cássia"];
// Iteração sem o indíce
foreach($names as $name){
    echo $name . " ";
}
// Retorno: João Giulia Ana Cássia

echo "\n----------------------------------------------\n";

echo "ITERAÇÃO FOREACH COM INDICE\n";
// Iteração com o indíce
foreach($names as $key => $name){
    echo $key . "." . $name . " ";
}
// Retorno: 0.João 1.Giulia 2.Ana 3.Cássia

echo "\n----------------------------------------------\n";

/** Como primeiro parâmetro, o foreach espera um array ou objeto onde ele possa percorrer os índices.
 *
 * Como segundo parâmetro, será o nome da váriavel que receberá o valor da iteração. Porém caso você 
 * queira colocar o índice e valor da iteração, você deverá atribuir mais uma variável com o sinal de 
 * igual maior =>, colocando o nome da variável de índice atrás da seta e a variável com o valor a da 
 * iteração após a seta.
 * foreach ($array as $iteracao => $valor)
 */

echo "EXEMPLO 1 - ITERANDO UM OBJETO\n";

$pessoa = new StdClass;
$pessoa->nome = "João Vidal";
$pessoa->idade = 23;
$pessoa->trabalho = "Fullstack Developer";

foreach ($pessoa as $chave => $valor) {
    echo "$chave: $valor" . PHP_EOL;
}
// Resultado:
// nome: João Vidal
// idade: 23
// trabalho: Fullstack Developer

echo "\n\n";

echo "O MESMO SERVE PARA ARRAYS\n";

$pessoaArray = [
    "nome" => "João Vidal",
    "idade" => 23,
    "trabalho" => "Fullstack Developer"
];
foreach ($pessoaArray as $chave => $valor) {
    echo "$chave: $valor" . PHP_EOL;
}

// Resultado:
// nome: João Vidal
// idade: 23
// trabalho: Fullstack Developer

echo "\n\n";

echo "QUANDO NÃO TEM CHAVE DECLARADA O ARRAY DEVOLVE O ÍNDICE\n";

$pessoaArray = [
    "João Vidal",
    23,
    "Fullstack Developer"
];
foreach ($pessoaArray as $chave => $valor) {
    echo "$chave: $valor" . PHP_EOL;
}

// Resultado:
// 0: João Vidal
// 1: 23
// 2: Fullstack Developer

echo "\n\n";

echo "PARA ITERAR SEM A CHAVE BASTA OCULTA-LA\n";

$pessoaArray = [
    "João Vidal",
    23,
    "Fullstack Developer"
];
foreach ($pessoaArray as $valor) {
    echo "$valor" . PHP_EOL;
}

// Resultado:
// João Vidal
// 23
// Fullstack Developer


echo "-----------------------------------------------------------------------------\n";

echo "CONTROLANDO SUAS REPETIÇÕES COM CONTINUE\n";

/**
 * Bom, agora que entendemos sobre loops, podemos encontrar algumas situações, onde queremos
 * controlar o fluxo de interação. Seja pulando uma interação especifica, ou simplesmente interromper 
 * sua execução. Para estes casos temos o continue e o break.
**/

for ($numero = 0; $numero < 10; $numero++) {
    if($numero % 2 === 1){
        continue;
    }

    echo $numero . " é par.\n";
    // Resultado:
    // 0: 0 é par
    // 2: 2 é par 
    // 4: 4 é par
}
// O comando continue, é funcional para as estruturas for, while, foreach e do-while.

echo "-----------------------------------------------------------------------------\n";

echo "CONTROLANDO SUAS REPETIÇÕES COM BREAK\n";

while(true){
    echo "Olá seja bem vindo, qual mensagem deseja enviar?"  . PHP_EOL;
    echo "1. Bom dia" . PHP_EOL;
    echo "2. Boa tarde". PHP_EOL;
    echo "3. Boa noite" . PHP_EOL;
    echo "0. SAIR" . PHP_EOL;
    
    // Nota: a função readline, é apenas uma maneira de coletar a informação vinda de um usuario. 
    $resposta = readline ('Digite uma opção: '); // digitei: 1
    
    if($resposta == '1') {
        echo 'Bom dia' . PHP_EOL;
    } else if($resposta == '2') {
        echo 'Boa tarde' . PHP_EOL;
    } else if ($resposta == '3') {
        echo 'Boa noite' . PHP_EOL;;
    }else if($resposta == '0') {
        echo 'Bye!' . PHP_EOL;
        break;
    }
}

// AVISO: não é recomendado utilizar switch no looping infinito pois o break pararia o switch e não o while





