<?php 
namespace App\Controllers;

class CheckoutController extends Controller{
    public function index(){ 
        $this->render("Checkout/index");
    }
}