<?php

/** O PHP suporta várias opções de comparação de valores e vamos aprender sobre, antes, entenda que:
 * - (um) 1 é a mesma coisa que true
 * - (zero) 0 é a mesma coisa que false
 */

// IGUALDADE (==)
// O operador igual duplo (==) compara dois valores e retorna true se forem iguais e false se forem diferentes

echo "IGUALDADE (==)\n";
echo (0 == false) . PHP_EOL; // true
echo ('123' == 123) . PHP_EOL; // true
echo ('um' == 1) . PHP_EOL; //false
echo (123.0 == 123) . PHP_EOL; //true
/** RETORNA
 * 1
 * 1
 * 
 * 1
 */

echo "--------------------------------------------\n";

// DIFERENÇA (!=)
// Se os valores forem diferentes retorna true, se forem iguais o retorno é false

echo "DIFERENÇA (!=)\n";
echo (0 != false) . PHP_EOL; //false
echo ('123' != 123) . PHP_EOL; //false
echo ('um' != 1) . PHP_EOL; //true
echo (123.0 != 123) . PHP_EOL; //false

/** RETORNA
 * 
 * 
 * 1
 * 
 */

 echo "--------------------------------------------\n";

// IDÊNTICO (===)
// O PHP também pode testar se um valor é igual e do mesmo tipo

echo "IDÊNTICO (===)\n";
echo (0 === false) . PHP_EOL; //false
echo ('123' === 123) . PHP_EOL; //false
echo ('um' === 1) . PHP_EOL; //false
echo (123.0 === 123) . PHP_EOL; //false

//É tudo falso :(, por isso não retorna nada

echo "--------------------------------------------\n";

// NÃO IDẼNTICO (!==)

echo "NÃO IDÊNTICO (!==)\n";
echo (0 !== false) . PHP_EOL; //true
echo ('123' !== 123) . PHP_EOL; //true
echo ('um' !== 1) . PHP_EOL; //true
echo (123.0 !== 123) . PHP_EOL; //true

/** RETORNO
 * 1
 * 1
 * 1
 * 1
 */

echo "--------------------------------------------\n";

// MAIOR & MENOR QUE

echo "MAIOR E MENOR QUE (>, <, >=, <=)\n";
echo (2 < 3) . PHP_EOL; //true
echo (2 > 3) . PHP_EOL; //false
echo (2 <= 3) . PHP_EOL; //true
echo (2 >= 3) . PHP_EOL; //false

/** RETORNA
 * 1
 * 
 * 1
 * 
 */




/** NOTAS
 * - O PHP tenta converter os valores na comparação de igual duplo (==), e diferente (!=)
 * - Por isso que a string '123' é igual (==) ao número 123 e o retorno é true
 * - Na comparação de idênticos (===) o PHP não tenta converter os valores
 * - Por isso, string '123' não é idêntica (===) ao número 123, o retorno é false  
 */
