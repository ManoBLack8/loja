<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('grant_type' => 'authorization_code','client_id' => '1437','client_secret' => 'QnHggAHMl6emBQ9RQ44lszJW4uLDKI3NoHhwWJkk','redirect_uri' => 'https://eugarimpo.com/','code' => 'def50200ac6b88e96366064e1b9c0225b98cd167e8ee54c40989c2f8e5c86b0b34108566bab6ef548be3853b53646338169e7ff51e1cde643531e441fd8fde127cef816519b2db8f6c1c5f6a259cb905be04b940bae2847c2b0f40f18be96f9f71027b91505b60e54d8686c5ceca5cff57f949c4aa4771c74fb7f8777779719f745dd00554133f39471df5251c8cc5b9bf932646ff51a1fe258c87fc2b3e011fc8ecea190420fdf0b88402cc5aafcb14a94b1aa5fe5642a206dd11b7face490933f6a31c04901383848883a083f4eee837c27795f09bfe952736ebe43e985cb00d7e0ceab73e1fe6cb0cb31dbba71a2a12b3b6bdfa1657b298351fb09234afde3c0c9372d6a29455e04284fd8d5c813c623a8bc7376238c577391801ec4d375f9873acfa9bbfd546aa4dd3f70700ac7349e9b66e210a08777bb72a8a87627853b9944fdf0c6e600f1d68652f4e0ea295225f37a2c5e16388b2c6aa1c0477bc56e7527c4e0d8be0e900296b0da6944df424435e1e3bda35c2a53dd082ff60b0ec33881db3a6ba71235d9ff6ff0ec9b6e793e50949'),
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'User-Agent: Aplicação (email para contato técnico)'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
