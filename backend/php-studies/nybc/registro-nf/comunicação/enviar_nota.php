<?php


$token = ""; //893b02ac2d3c5b315e3e011a72a2965a22b8c3d789001425f069c510291ac299d94468cc

$url = 'https://bling.com.br/Api/v2/notafiscal/json/';

$xml = 'arquivo.xml';
$posts = array (
    "apikey" => $token,
    "xml" => rawurlencode($xml)
);
$retorno = executeSendFiscalDocument($url, $posts);
echo $retorno;
function executeSendFiscalDocument($url, $data){
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_POST, count($data));
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}