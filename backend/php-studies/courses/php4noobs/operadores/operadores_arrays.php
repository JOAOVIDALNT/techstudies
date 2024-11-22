<?php
/** O PHP manda muito bem quando se trata de processamento de arrays/matrizes. Existem muitas 
 * funções internas para auxiliar nisso. 
 * Vejamos os operadores que podemos usar ao fazer operações com arrays:
 */

// UNIÃO
// Você pode unir um ou mais valores de arrays

echo "UNIÃO DE ARRAY\n";

$array1 = [0 => 'PHP', '1' => 'JAVA', 2 => 'C#'];
$array2 = [3 => 'JavaScript'];

print_r($array1 + $array2);

/** RETORNO:
 * Array
 * (
 *  [0] => PHP
 *  [1] => JAVA
 *  [2] => C#
 *  [3] => JavaScript
 * )
 */

echo "--------------------------------\n";

// IGUALDADE (==)
// Verifica se os valores dos arrays passados são iguais
echo "IGUALDADE (==)\n";
$array3 = [0 => 1];
$array4 = [0 => 1];

echo $array3 == $array4;
echo "\n";

//Retorna: 1, significa que os valores dos arrays são iguais

echo "--------------------------------\n";

// DIFERENÇA (!= ou <>)
echo "DIFERENÇA (!= ou <>)\n";
$array4 = [0 => 2];

echo $array3 != $array4;
echo "\n";

//Retorna: 1, significa que os valores dos arrays são diferentes

echo "--------------------------------\n";

// IDÊNTICO
// Verifica se valores dos arrays são iguais e do mesmo tipo
echo "IDÊNTICO (===)\n";
$array4 = [0 => 1];

echo $array3 === $array4;
echo "\n";

//Retorna: 1, significa que os valores dos arrays são iguais e do mesmo tipo (número inteiro)

echo "--------------------------------\n";

// NÃO IDÊNTICO
echo "NÃO IDÊNTICO (!==)\n";
$array4 = [0 => '1'];

echo $array3 !== $array4;
echo "\n";

//Retorna: 1, significa que os valores dos arrays não são iguais e/ou não são do mesmo tipo (número inteiro)

/** NOTAS
 * SE ESTIVER USANDO ALGUMA VERSÃO DO PHP ANTES DA 5.4 A DEFINIÇÃO DOS ARRAYS É DIFERENTE
 * A FUNÇÃO print_r() É MUITO ÚTIL PARA TESTAR ARRAYS
 */


