<?php
$_GET
$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=viniciusfe66@gmail.com&token=72432ABEE1624ED0A49772EAA51F09C6';
$Curl = curl_init($url);
curl_setopt($Curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1"));
curl_setopt($Curl, CURLOPT_POST, 1);
curl_setopt($Curl, CURLOPT_RETURNTRANSFER, TRUE);
$retorno = curl_exec($Curl);

$Xml=simplexml_load_string($retorno);
echo json_encode($Xml);

?>