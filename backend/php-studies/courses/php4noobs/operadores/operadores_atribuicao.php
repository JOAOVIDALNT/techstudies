<?php

/** Funciona como nas outras linguagens, exemplos:
 * - abreviação de operador aritmético (+=). -> $result += 10;
 * - operação de incremento e decremento (++ & --) com algumas ressalvas (exemplo à seguir)
 */

/** INCREMENTO DE DECREMENTO
 * O PHP suporta operadores de incremento e decremento, A ORDEM DO OPERADOR É IMPORTANTE AQUI.
 * - Colocar um ++ antes de uma variável em um echo incrementa a variável em 1 >antes da avaliação<.
 * - Colocar o operados após a variável incrementa >após a avaliação<. 
 * a mesma regra serve para o decremento (--)
 */

 // EXEMPLO DE INCREMENTO E DECREMENTO

 $variavel = 10;

 echo 'O valor da variável foi incrementado e agora é = ' . ++$variavel . PHP_EOL;
 echo 'O valor da variável foi incrementado, mas ainda não mudou então ainda é = ' .$variavel++ . "\n";
 echo 'O valor da variável agora é = ' .$variavel . PHP_EOL;

/** -- Retorna
 * O valor da variável foi incrementado e agora é = 11
 * O valor da variável foi incrementado, mas ainda não mudou então continua sendo = 11
 * O valor da variável agora é = 12
 */


/** NOTAS
 * - Quando não precisar interpretar variáveis use aspas simples '', isso poupa processamento.
 * - PHP_EOL é uma constante do PHP que serve para quebrar linhas.
 */