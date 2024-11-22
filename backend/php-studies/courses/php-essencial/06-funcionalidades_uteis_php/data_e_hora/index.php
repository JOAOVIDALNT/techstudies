<?php 

// TIMESTAMP RETORNA A QUANTIDADE EM SEGUNDOS DO DIA  01/01/1970 ATÉ A DATA ATUAL OU DETERMINADA

echo "<p>Timestamp atual -> " .time() . "</p>"; // exibe o timestamp atual


// é possível fazer cálculos através dessa função, como por exemplo:
echo "<p>Dias entre hoje e 25 de maio de 2022 -> ". (time() - strtotime("2022-05-25"))/86400 .  "</p>";


// FUNÇÃO DATE: RECEBE 2 PARÂMETROS -> O FORMATO E O TIMESTAMP EX:
echo "<p>Dia da semana do dia 01-01-1970 -> " . date('D', strtotime("1970-1-1")) . "</p>"; // a formatação D maiúsculo sozinha define que deve-se retornar o dia da semana do timestamp informado 
// REF: https://www.php.net/manual/pt_BR/function.date.php

echo "<p>Conversão de data do padrão americano para o brasileiro -> " . date('d/m/Y', strtotime("2000-01-13")) . "</p>";

echo "<p>Convertendo o timestamp atual pro formado do banco de dados -> " . date("Y-m-d H:i:s", time()) . "</p>";

