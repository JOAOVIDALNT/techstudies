<?php

/** ARRAYS (VETORES)
 * Um array no PHP é na verdade um mapa ordenado. Um mapa é um tipo que relaciona valores à chaves.
 * Este tipo é otimizado para vários usos diferentes: ele pode ser tratado como um array,
 * uma lista (vetor), hashtable (que é uma implementação de mapa), dicionário, coleção, pilha, fila
 * e probavelmente mais. Assim como existe a possibilidade dos valores do array serem outros arrays,
 * árvores e arrays multidimensionais.
 */

 /**
  * Um array pode ser criado com o construtor de linguagem array() ou por []. Ele leva qualquer
  * quantidade de pares separados por vírgula | chave => valor como argumentos.
  */

$array1 =  array(
    "dev" => "João Vidal",
    "languages" => "PHP, Java, C#, JavaScript"
);
// Ou se você preferir um jeito mais simples de instanciar um array:
$array2 = [
    "dev" => "João Vidal",
    "languages" => "PHP, Java, C#, JavaScript"
];
echo "ARRAY DUMP (array associativo)\n";
// var_dump($array1);
var_dump($array2);
echo "\n";

/** SAIDA
 * array(2) {
 * ["dev"]=>
 * string(11) "João Vidal"
 * ["languages"]=>
 * string(25) "PHP, Java, C#, JavaScript"
 * }
 * array(2) {
 * ["dev"]=>
 * string(11) "João Vidal"
 * ["languages"]=>
 * string(25) "PHP, Java, C#, JavaScript"
 * }
 */

// Agora vamos entender como mostrar a saída de um vetor. Vamos declarar dois vetores e trabalhar com eles:

$array3 = [
    'João Vidal',
    'Giulia Tomé'
];
echo "Colhendo dados de um ARRAY ASSOCIATIVO\n";
// Array associativo
echo $array2['dev'] . "\n";
echo $array2['languages'] . "\n";

echo "Colhendo dados de um ARRAY NÃO ASSOCIATIVO\n";
// Array não associativo
echo $array3[0] . "\n";
echo $array3[1] . "\n";
