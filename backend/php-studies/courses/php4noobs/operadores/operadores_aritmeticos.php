<?php

// Os operadores aritméticos funcionam como nas outras linguagens, com algumas ressalvas:

// É possível criar variáveis dentro de parênteses pra realizar um cálculo EX:

$a = 2;
echo $a * ($b = 3) . "\n";

/**
 * O operador subtração, antes de uma variavel ou número transforma o número ou variável para o oposto
 * se for negativo vira positivo, se for positivo vira negativo.
 */

 $num1 = 88;
 $num2 = -$num1;

 echo $num1 . "\n";
 echo $num2 . "\n";
 