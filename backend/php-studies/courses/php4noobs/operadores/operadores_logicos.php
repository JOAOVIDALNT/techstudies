<?php
/** OPERADORES LÓGICOS
 * Operadores lógicos operam com valores booleanos. Por isso, eles convertem valores para um Booleano
 * antes de tentar a operação.
 */

// E (&&, and)
// true, se ambos os operandos (valores a serem testados), forem verdadeiros.
echo "E (&&, and):\n";

$a = true;
$b = true;

var_dump($a && $b);
//Retorna: bool(true)

echo "----------------------------------------\n";

/** OU (||, or)
 * Este operador lógico é conhecido como: OU Inclusivo, e vai retornar true se um dos operandos for
 * verdadeiro, ou ambos.
 */
echo "OU (||, or):\n";

$a = false;
$b = true;

var_dump($a || $b);
//Retorna: bool(true)

echo "----------------------------------------\n";

/** XOR (^, xor)
 * Este operador lógico é conhecido como: OU Exclusivo, e vai retornar true se um dos operandos for
 * verdadeiro, mas não ambos.
 */
echo "XOR (^, xor):\n";

$a = true;
$b = true;

var_dump($a ^ $b);
//Retorna: int(0) zero, ou seja, falso, pois ambos os operandos é verdadeiro.

$a = true;
$b = false;

var_dump($a ^ $b);
//Retorna: int(1), ou seja, true, pois apenas um dos operandos é verdadeiro;

echo "----------------------------------------\n";

// NÃO (!, not)
// É um operador de negação
echo "NÃO (!, not):\n";

$a = true;

var_dump(!$a);

//Retorna: bool(false), aqui negamos uma variável verdadeira e ela se tornou falsa.

// Preste muita atenção pois:
// Os símbolos &&, || e ^ têm maior ordem de precedência, e são avaliados primeiro que and, or, e xor. Na prática eles fazem a mesma coisa, mas os símbolos sempre vão ser avaliados primeiro nas expressões, evite mistura-los.