<?php

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/6D9AD10A-49E9-4922-AE77-67690848EE77?email=viniciusfe66@gmail.com&token=7cfc5143-7d20-48cb-9822-4288266289586f30b2664a6796d4c6d9a85a101c8e321932-af6c-4ccb-9b02-967a391c5e0d',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/xml'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
