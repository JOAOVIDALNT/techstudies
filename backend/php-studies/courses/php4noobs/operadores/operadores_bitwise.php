<?php
// OPERADORES BITWISE (BIT A BIT)

// Operadores bitwise permitem a avaliação e modificação de bits específicos em um tipo inteiro.

/**
 * E -> &
 * OU -> |
 * OU exclusivo -> ^
 * Não -> ~
 * Deslocar à esquerda -> <<
 * Deslocar à direita -> >>
 */


 /** Explicando melhor
  * Os operadores bitwise: &, |, ^ comparam dois valores inteiro utilizando suas representações
  * binárias, e retornam um novo valor. Cada bit será comparado e a formação desse novo valor depende
  * do operador que você usar
  */

// EXEMPLOS


// Operador E -> &
// Retorna 1 se ambos os bits comparados forem iguais a 1, caso contrário, retorna 0.
echo "OPERADOR E (&)\n";
echo 9 & 7;
echo "\n";
// 9 em binário é: 00001001
// 7 em binário é: 00000111
// resultado:      00000001

//Retorna: "1" que é o binário 00000001 

echo "-----------------------------------------------------------\n";

// Operador OU -> |
// Retorna 1 se um dos bits comparados for igual a 1, caso contŕario, retorna 0.
echo "OPERADOR OU (|)\n";
echo 9 | 7;
echo "\n";
// 9 em binário é: 00001001
// 7 em binário é: 00000111
// resultado:      00001111

//Retorna: "15" que é o binário 00001111 

echo "-----------------------------------------------------------\n";

// Operador OU exclusivo -> ^
// Retorna 1 se ambos os bits comparados forem diferentes, caso contrário, retorna 0.
echo "OPERADOR OU exclusivo (^)\n";
echo 9 ^ 7;
echo "\n";
// 9 em binário é: 00001001
// 7 em binário é: 00000111
// resultado:      00001110

//Retorna: "14" que é o binário 00001110 

echo "-----------------------------------------------------------\n";

// Operador Não -> ~
// Tem a função de inverter bits. O bit que era 0 se torna 1 e o bit que era 1 se torna 0.

echo "OPERADOR NÃO (~)\n";
$a = -9;
$a = ~$a;

echo $a . "\n";

//diferente dos outros exemplos aqui representamos o valor com 20 bits
// -9 em binário é:                 11111111111111110111
// após a operação o é resultado:   00000000000000001000

//Retorna: "8" que é o binário 00000000000000001000

echo "-----------------------------------------------------------\n";

/** Operador Deslocar à esquerda -> <<
 * Desloca os bits de $a, $b passos para a esquerda (cada passo significa "multiplicar por dois")
 * ou seja, $a << 7, é o mesmo que multiplicar $a por 2 sete vezes.
 */

echo "OPERADOR DESLOCAR À ESQUERDA (<<)\n";
$a = 9;
$b = 7;

echo $a << $b . "\n";

//Retorna: "1152" que é o resultado de 9*2*2*2*2*2*2*2

echo "-----------------------------------------------------------\n";

/** Operador Deslocar à direita -> >>
 * Desloca os bits de $a, $b passos para a direita (cada passo significa "divide por dois")
 * ou seja, $a >> 7, é o mesmo que dividir $a por 2 sete vezes.
 */

echo "OPERADOR DESLOCAR À DIREITA (>>)\n";
$a = 9;
$b = 7;

echo $a >> $b . "\n";

//Retorna: "0" que é o resultado de 9/2/2/2/2/2/2/2
//Se você fizer a operação acima na calculadora o resultado vai ser igual a 0.0703125
//o PHP retorna o valor inteiro nesta operação


/** NOTAS
 * - Bit é a manor unidade de informação na computação e pode ser 0 ou 1, ligado ou desligado.
 * - um byte tem 8 bits.
 * - Não se preocupe com os operadores bit a bit por hora, basta conhece-los
 */