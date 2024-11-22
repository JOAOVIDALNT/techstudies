<?php


	
$code = "1491931.129614.0";
$apikey = "893b02ac2d3c5b315e3e011a72a2965a22b8c3d789001425f069c510291ac299d94468cc";
$outputType = "json";
$url = 'https://bling.com.br/Api/v2/produto/' . $code . '/' . $outputType;
$retorno = executeGetProduct($url, $apikey);
echo $retorno;
function executeGetProduct($url, $apikey){
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}