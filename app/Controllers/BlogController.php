<?php
namespace App\Controllers;
use App\Controllers\Controller;
class BlogController extends Controller{

    public function index(){
        $this->render("Blog/index");
    }
}