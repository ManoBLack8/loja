<?php require_once("conexao.php");
session_start();
$itens_do_carrinho = itensDoCarrinho(@$_SESSION["id_usuario"]);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Brechó online | Moda Vintage & Atemporal🍂
Para você que preza por inclusão, diversidade e autenticidade brecho online">
    <meta name="keywords" content="Brechó, encontrei lá brecho, encontrei la, moda atemporal, cuiabá MT, encontrei!, juliana, de, souza, silva">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nome ?></title>

    <!-- Css Styles -->
    <link rel="shortcut icon" href="icones e logos/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="./index.php"><img src="img/logo-nova.png"  alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="./carrinho.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>R$00,00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="sistema"><i class="fa fa-user"><?php
                if (@$_SESSION["id_usuario"] == null) {
                 echo "Login";
                }else {
                    echo $_SESSION["nome_usuario"];
                }?></i></a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Ínicio </a></li>
                <li><a href="./shop.php">Shop</a></li>
                <li><a href="#">Paginas</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-detalhes.php">Detalhes de peças</a></li>
                        <li><a href="./carrinho.php">Carrinho</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog detalhes</a></li>
                    </ul>
                </li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/encontrei_labrecho/"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?php echo $email ?></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i><?php echo $email ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/encontrei_labrecho/"><i class="fa fa-instagram"></i></a>
                            </div>
                            <div class="header__top__right__auth">
                                <nav class="header__menu2">
                                    <ul>
                                        <li><a href="#"></a><a href="sistema"><i class="fa fa-user"></i><?php if (@$_SESSION["id_usuario"] == null) {
                                        echo "Login";
                                        }else {
                                            echo $_SESSION["nome_usuario"];
                                        } ?></a>
                                <ul class="header__menu__dropdown text-center login">
                                                <li><a href="./carrinho.php">Meus Pedidos</a></li>
                                                <li><a href="carrinho.php">Carrinho</a></li>
                                                <li><a href="sistema">Sair</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo-nova.png" width="120" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Ínicio</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="#">Paginas</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-detalhes.php">Detalhes da peça</a></li>
                                    <li><a href="./carrinho.php">Carrinho</a></li>
                                    <li><a href="./checkout.php">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Detalhes</a></li>
                                </ul>
                            </li>
                            <li><a href="contato.php">Contato</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="./carrinho.php"><i class="fa fa-shopping-cart"></i> <span><?= count($itens_do_carrinho)+ 1 ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="shop.php" method="POST">
                                <input type="text" name="pesquisar" placeholder="Do que vc precisa ?" value="<?= @$_POST["pesquisar"] ?>">
                                <button type="submit" class="site-btn">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
