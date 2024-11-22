<?php

// O PHP utiliza o '.' para concatenar Strings
// A concatenação pode ser feita de 3 formas

// SÓ CONCATENANDO
$euQuero = 'Eu quero ser um programador' . ' PHP';

echo $euQuero . PHP_EOL;

// CONCATENANDO DE FORMA ABREVIADA (.=)
$euQuero = 'Eu quero ser um programador';
$euQuero .= ' PHP';

echo $euQuero . PHP_EOL;

// CONCATENANDO VARIÁVEIS
$euQuero = 'Eu quero ser um programador';
$php = ' PHP';

echo $euQuero . $php . PHP_EOL;
