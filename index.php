<?php require_once("cabecalho.php");

?>
<section>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/banner/banner1.png" class="banner" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/banner/banner2.png" class="banner" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/banner/banner3.png" class="banner" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>

<!-- Featured Section Begin -->
<section class="featured spad">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="section-title">
                  <h2>Produtos Destaques</h2>
              </div>
              <div class="featured__controls">
                  <ul>
                      <li class="active" data-filter="*">Todas</li>
                      <li data-filter=".cima">Partes de cima</li>
                      <li data-filter=".baixo">Partes de Baixo</li>
                      <li data-filter=".acessorios">Acessorios</li>
                      <li data-filter=".calcados">Calçados</li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="row featured__filter">
				<div class="col-lg-3 col-md-4 col-sm-6 mix calcados">
					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="img/produtos/sapato.png">
							<ul class="featured__item__pic__hover">
								<li><a href="#"><i class="fa fa-heart"></i></a></li>
								<li><a href="#"><i class="fa fa-retweet"></i></a></li>
								<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
							<h6><a href="#">Tenis All stars</a></h6>
							<h5>R$ 50,00</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mix cima">
					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="img/produtos/k1.png">
							<ul class="featured__item__pic__hover">
								<li><a href="#"><i class="fa fa-heart"></i></a></li>
								<li><a href="#"><i class="fa fa-retweet"></i></a></li>
								<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
							<h6><a href="#">Kimono</a></h6>
							<h5>R$ 50,00</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mix cima">
					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="img/produtos/camisaverde.png">
							<ul class="featured__item__pic__hover">
								<li><a href="#"><i class="fa fa-heart"></i></a></li>
								<li><a href="#"><i class="fa fa-retweet"></i></a></li>
								<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
							<h6><a href="#">Camisa verde</a></h6>
							<h5>R$ 50,00</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mix acessorios">
					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="img/produtos/juliet.png">
							<ul class="featured__item__pic__hover">
								<li><a href="#"><i class="fa fa-heart"></i></a></li>
								<li><a href="#"><i class="fa fa-retweet"></i></a></li>
								<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
							<h6><a href="#">juliet</a></h6>
							<h5>R$ 50,00</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mix baixo">
					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="img/produtos/calça.png">
							<ul class="featured__item__pic__hover">
								<li><a href="#"><i class="fa fa-heart"></i></a></li>
								<li><a href="#"><i class="fa fa-retweet"></i></a></li>
								<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
							<h6><a href="#">calça</a></h6>
							<h5>R$ 50,00</h5>
						</div>
					</div>
				</div>
          </div>
      </div>
  </section>
 
    
    <?php require_once("Roda_pe.php")?>