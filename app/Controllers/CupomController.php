<?php
namespace App\Controllers;
use App\Model\Cupom;
class CupomController extends Controller {
    function index(){
        $cupoms = new Cupom();
        $cupoms = $cupoms->read();
        if(count($cupoms) > 0) {
            foreach ($cupoms as $cupom){
                if($cupom["chave"] == $_POST["cupom"]){
                    $cupom_valor = $cupom["desconto_por"];
                    if ( strtotime($cupom["data_fim"]) < time()) {
                        echo "esse cupom não está mais disponivel";
                        exit;
                    }
                    echo "cupom aplicado: <strong>".$cupom["chave"]."</strong>
                    <input type='hidden' id='desconto' name='desconto' value='".$cupom_valor."'>";
                }else {
                    echo "nenhum cupom encontrado";
                }
            }
        }
        else {
            echo "nenhum cupom encontrado";
        }
        
    }

}
