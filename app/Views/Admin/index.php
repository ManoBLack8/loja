<?php 
require_once '../app/Views/layout/header.php';
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../Admin">

                <div class="sidebar-brand-text mx-3">Administrador</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cadastros
            </div>



            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-box-open"></i>
                    <span>Produtos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="../Admin/produtos">Produtos</a>
                        <a class="collapse-item" href="../Admin/categorias">Categorias</a>
                        <a class="collapse-item" href="../Admin/subCategorias">Sub Categorias</a>
                        <a class="collapse-item" href="../Admin/tipoEnvios">Tipo Envios</a>
                        <a class="collapse-item" href="../Admin/caracteristicas">Características</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-percent"></i>
                    <span>Combos e Promoções</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="../Admin/combos">Combos</a>
                        <a class="collapse-item" href="../Admin/promocoes">Promoções</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Consultas
            </div>



            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../Admin/clientes">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Clientes</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="../Admin/vendas">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Vendas</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Admin/backup">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Backup</span></a>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                    </ul>
                    <!-- End of Sidebar -->

                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">

                        <!-- Main Content -->
                        <div id="content">

                            <!-- Topbar -->
                            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                                <!-- Sidebar Toggle (Topbar) -->
                                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                    <i class="fa fa-bars"></i>
                                </button>



                                <!-- Topbar Navbar -->
                                <ul class="navbar-nav ml-auto">



                                    <!-- Nav Item - User Information -->
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">José</span>
                                            <img class="img-profile rounded-circle" src="../../src/img/produtos/sem-foto.png">

                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                                Editar Perfil
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="../logout.php">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                                Sair
                                            </a>
                                        </div>
                                    </li>

                                </ul>

                            </nav>
                            <!-- End of Topbar -->

                            <!-- Begin Page Content -->
                            <div class="container-fluid">

                                <?php if ($data["pag"]) { 
                                    include_once($data["pag"].".php");
                                } else if ($data["pag"] == null || @$data["pag"] == '' ) {
                                    include_once("home.php");
                                }
                                ?>



                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->



                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>




                <!--  Modal Perfil-->
                <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>



                            <form id="form-perfil" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">



                                    <div class="form-group">
                                        <label >Nome</label>
                                        <input value="<?php echo @$nome_usu ?>" type="text" class="form-control" id="nome-usuario" name="nome-usuario" placeholder="Nome">
                                    </div>

                                    <div class="form-group">
                                        <label >CPF</label>
                                        <input value="<?php echo @$cpf_usu ?>" type="text" class="form-control" id="cpf-usuario" name="cpf-usuario" placeholder="CPF">
                                    </div>

                                    <div class="form-group">
                                        <label >Email</label>
                                        <input value="<?php echo @$email_usu ?>" type="email" class="form-control" id="email-usuario" name="email-usuario" placeholder="Email">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >Senha</label>
                                                <input value="" type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label >Confirmar Senha</label>
                                                <input value="" type="password" class="form-control" id="conf-senha" name="conf-senha" placeholder="Senha">
                                            </div>
                                        </div>
                                    </div>






                                    <small>
                                        <div id="mensagem-perfil" class="mr-4">

                                        </div>
                                    </small>



                                </div>
                                <div class="modal-footer">



                                    <input value="<?php echo $_SESSION["usuario"]["id"] ?>" type="hidden" name="txtid" id="txtid">
                                    <input value="<?php echo $_SESSION["usuario"]["documento"] ?>" type="hidden" name="antigo" id="antigo">

                                    <button type="button" id="btn-fechar-perfil" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div> 
            </body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<?php require_once '../app/Views/layout/footer.php'; ?>

<script type="text/javascript">
    $('#btn-salvar-perfil').click(function(event){
        event.preventDefault();
        
        $.ajax({
            url:"editar-perfil.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
               if(msg.trim() === 'Salvo com Sucesso!'){
                                        
                    $('#btn-fechar-perfil').click();
                    window.location='index.php';

                    }
                 else{
                    $('#mensagem-perfil').addClass('text-danger')
                    $('#mensagem-perfil').text(msg);
                   

                 }
            }
        })
    })
</script>
