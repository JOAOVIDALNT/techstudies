<?php
require 'vendor/autoload.php';


use Curso\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client as ClientAlias;
use Symfony\Component\DomCrawler\Crawler; // adaptação para $crawler = new \Symfony\Component\DomCrawler\Crawler();

$client = new ClientAlias(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo $curso . PHP_EOL;
}


