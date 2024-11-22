<?php
// VARIÁVEIS
/**
 * No php a tipagem é dinâmica, não precisa especificar tipo.
 * - Toda variável no PHP é declarada por $ e em seguida o nome da variável
 * - O jeito correto e válido para declarar o nome de uma variável no PHP é iniciar por underline
 * ou letra seguido de qualquer letra, números ou sublinhads.
 * - As variáveis no PHP são case-sensitives, então, $Joao não é o mesmo que $joao
 * - o $this é uma variável que não pode ser atribuída, iremos aprender mais pra frente
 * - Você pode juntar duas variáveis, strings ou qualquer tipo com a concatenação, que é usado o sinal
 * (.) entre os elementos.
 */
// Exemplos de case sensitive
$Variavel = "Eu ";
$variavel = "Adorei ";
$variaveL = "programar em PHP";

echo $Variavel . $variavel . $variaveL . "\n";

// Exemplo de mudança de valor
$idade = '22 anos';
echo "Me chamo João e ontem eu tinha " .$idade . "\n";
$idade = '23 anos';
echo "Fiz aniversário e agora tenho " .$idade . "\n"; 