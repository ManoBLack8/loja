<?php

$id = @$_POST['id']; 
$pag = "produtos";

$query = $this->conn->query("SELECT * FROM imagens where id_produto = '" . $id . "' ");
echo "<div class='row'>";
 $res = $query->fetchAll(PDO::FETCH_ASSOC);

  for ($i=0; $i < count($res); $i++) {                   
    echo "<img class='ml-4 mb-2' src='../../img/produtos/" . $res[$i]['imagens'] . "' width='70'><a href='#' onClick='deletarImg(". $res[$i]['id'] .")'><i class='text-danger fas fa-times ml-1'></i></a>";

  }
    echo "</div>";