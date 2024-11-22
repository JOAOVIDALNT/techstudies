<?php

// ESTRUTURAS DE CONTROLE
// A maior parte é igual ao padrão das linguagens. 
// IF/ELSE, SWITCH/CASE e IF TERNÁRIO.

// NO PHP TEMOS O MATCH E A COALESCÊNCIA NULA:

/** CONDIÇÃO: MATCH
 * O Match é uma novidade do PHP 8, com ela ganhamos uma nova opção para fazer comparações multiplas,
 * além dos classico if e else e do switch, visto anteriomente.
 *
 * O match apróxima-se bastante do switch, em sua lógica. Onde ele pecorre as opções e retorna a 
 * primeira que é compativel com suas condicionais. As diferenças entre eles é sua sintaxe mais elegante 
 * e suas operações sempre, são acompanhadas pela comparação com os tipos (===).
 *
 * Outra vantagem do match, é a relização de operações, entre cenário positivos (Exemplo 02), onde 
 * podemos fazer novas comparações, para encontrar um resultado esperado.
 */
echo "CONDIÇÃO MATCH 1\n";

$comando = "!site";
echo match($comando) {
    "!site" => "Link: https://joaovidal.dev.br",
    "!youtube", "!canal" => "Increva-se no canal: https://youtube.com/@fejotatech",
    default => "Use os comandos no chat!"
}; // ""Link: https://joaovidal.dev.br"

echo "\n--------------------------------------------------------------------\n";

/** Neste exemplo, vamos classificar a idade do usuario. Em vez de escrevermos um switch ou if/else
 * gigansteco, podemos reduzir esta logica a apenas 6 linhas.
 */
echo "CONDIÇÃO MATCH 2\n";

$idade = 21;
$result = match (true) {
    $idade >= 65 => 'Idoso',
    $idade >= 25 => 'Adulto',
    $idade >= 18 => 'Jovem adulto',
    default => 'Criança',
};

echo $result . "\n"; // "Jovem Adulto"

echo "--------------------------------------------------------------------\n";

/** CONDIÇÃO: COALESCÊNCIA NULA
 * O operador de coalescência nula (??) fornece uma forma conveniente de retornar o valor antes do 
 * sinal
 * de ?? caso o valor exista e não seja NULL ou retorna o valor após o sinal de ??.
 *
 * É especialmente útil quando queremos retornar um valor padrão caso uma chave não exista em um 
 * array 
 * associativo, pois é um ótimo substituto para o operador ternário ou uma estrutura de if/else 
 * nesses casos.
 */

$descricaoPorCodigo = array(
    1 => 'Este usuário já existe.',
    2 => 'Senha incorreta.',
    3 => 'Este usuário está bloqueado.',
);

// Exemplo utilizando operador ternário - Retorna 'Alguma coisa deu errado', pois a chave 5 não existe
return isset($descricaoPorCodigo[5]) ? $descricaoPorCodigo[5] : 'Alguma coisa deu errado.';

// A lógica acima pode ser simplicada utilizando o operador de coalescência nula
return $descricaoPorCodigo[5] ?? 'Alguma coisa deu errado.';


/** NOTAS
 * isset verifica a existência de uma variável ou uma chave e retorna um valor boleano. Se a variável/
 * chave existir e não possuir o valor igual a NULL o resultado retornado será TRUE, caso for NULL ou 
 * não existir, o resultado retornará FALSE.
 */