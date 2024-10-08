
   <div class="col-lg-12">

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                    <img src="img/mb.png" width="175" alt="">
                        <ul>
                            <li>Telefone: <?= $loja->telefone ?></li>
                            <li><?= $loja->email ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <ul>
                            <li><a href="quem_somos.php">Quem somos</a></li>
                            <li><a href="#">Sobre o Brecho</a></li>
                            <li><a href="#">Transporte seguro</a></li>
                            <li><a href="#">Informção Sobre entrega</a></li>
                            <li><a href="#">Politicas de privacidade</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">F.A.Q</a></li>
                            <li><a href="#">Sobre pagamentos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Receba nossas atualizações</h6>
                        <p>Insira seu email para receber</p>
                        <form action="#">
                            <input type="text" placeholder="Seu email">
                            <button type="submit" class="site-btn">Inscrever-se</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os diritos reservados | <?= $loja->nome ?> <i class="fa fa-rocket" aria-hidden="true"></i> feito por <a href="https://www.instagram.com/manoblack.dev/" target="_blank">Manoblack</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <?php require_once '../app/Views/layout/footer.php'; ?>
</body>

</html>