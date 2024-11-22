<?php

$apikey = "893b02ac2d3c5b315e3e011a72a2965a22b8c3d789001425f069c510291ac299d94468cc";
$documentNumber = 260026;
$documentSerie = 3;
$outputType = "json";
$url = 'https://bling.com.br/Api/v2/notafiscal/' . $documentNumber . '/'. $documentSerie . '/' . $outputType;
$retorno = executeGetFiscalDocument($url, $apikey);
echo $retorno;
function executeGetFiscalDocument($url, $apikey){
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}