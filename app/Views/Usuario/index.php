<?php require_once '../app/Views/layout/header.php';?>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">
                <img src="../src/img/logo-nova.png" width="200">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Seção de Informações do Usuário -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagem do Usuário">
                    <div class="card-body">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">johndoe@exemplo.com</p>
                        <p class="card-text">+123 456 7890</p>
                        <a href="#" class="btn btn-primary">Editar Perfil</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h4>Pedidos Recentes</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Pedido #</th>
                            <th scope="col">Data</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1234</th>
                            <td>2024-08-31</td>
                            <td><span class="badge bg-success">Enviado</span></td>
                            <td>R$99,99</td>
                        </tr>
                        <tr>
                            <th scope="row">1235</th>
                            <td>2024-08-29</td>
                            <td><span class="badge bg-warning">Pendente</span></td>
                            <td>R$59,99</td>
                        </tr>
                        <tr>
                            <th scope="row">1236</th>
                            <td>2024-08-25</td>
                            <td><span class="badge bg-danger">Cancelado</span></td>
                            <td>R$75,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php require_once '../app/Views/layout/footer.php'; ?>