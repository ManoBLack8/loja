<?php
                       $res = $pdo->query("SELECT * FROM andress where id_usuario = '".$id2."'");
                       $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                       if (@count($dados) > 0) {
                       $query3 = $pdo->query("SELECT * FROM andress where id_usuario = '" . $id2 . "'");
                       $ress2 = $query3->fetchAll(PDO::FETCH_ASSOC);
                       $cep = $ress2[0]['cep'];
                       $rua = $ress2[0]['rua'];
                       $complemento = $ress2[0]['complemento'];
                       $cidade = $ress2[0]['cidade'];
                       $cidade_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
                       strtr(utf8_decode(trim($cidade)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
                        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
                        $cidadee = preg_replace('/[ -]+/' , '-' , $cidade_novo);
                        if ($cidadee == "cuiaba") {
                            $frete = "7.00";
                        }
                        if ($cidadee == "varzea-grande") {
                            $frete = "10.00";
                        }
                        if (@$_GET['q'] == 'retirada') {
                            $frete = "00.00";
                        }
                        if (@$_GET['q'] == 'sacolinha') {
                            $frete = "00.00";
                        }

                        echo
                        '<div class="endereço_carrinho mt-5">
                        <li>Cep: <span>'.$cep.'</span> </li>
                        <li>Rua: <span>'.$rua.'</span> </li>
                        <li>Complemento: <span>'.$complemento.'</span></li>
                        </div>
                        <a href="checkout.php">novo enderereço</a>';
                       }
                        @$totaltotal = $total + $frete;
                       @$total = number_format($total, 2, ',', '.');
                        @$valorcar = number_format($valorcar, 2, ',', '.');
                        @$frete = number_format($frete, 2, ',', '.');
                        $totaltotal = number_format($totaltotal, 2, ',', '.');
     

                        ?>