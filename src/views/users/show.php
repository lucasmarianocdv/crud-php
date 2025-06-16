<?php

if (!isset($usuario) || !$usuario) {
    echo "<h4>Usuário não encontrado!</h4>";
    echo '<a href="/users" class="btn btn-danger mt-3">Voltar à Lista</a>';
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include(__DIR__ . '/../layout/navbar.php'); ?>
    <div class="container mt-5">
        <?php include (__DIR__ . '/../layout/mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                        <div class="card-header">
                            <h4>Visualizar Usuário
                                <a href="/users" class="btn btn-danger float-end">Voltar</a>
                            </h4>
                        </div>
                    <div class="card-body">
                            <div class="mb-3">
                                <label>ID</label>
                                <p class="form-control">
                                    <?= htmlspecialchars($usuario['id'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Nome</label>
                                <p class="form-control">
                                    <?= htmlspecialchars($usuario['nome'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <p class="form-control">
                                    <?= htmlspecialchars($usuario['email'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Data de Nascimento</label>
                                <p class="form-control">
                                    <?= htmlspecialchars(isset($usuario['data_nascimento']) ? date('d/m/Y', strtotime($usuario['data_nascimento'])) : 'N/A'); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Nickname</label>
                                <p class="form-control">
                                    <?= htmlspecialchars($usuario['nickname'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Telefone</label>
                                <p class="form-control">
                                    <?= htmlspecialchars($usuario['telefone'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Escritório</label>
                                <p class="form-control">
                                    <?= htmlspecialchars($usuario['escritorio'] ?? 'N/A'); ?>
                                </p>
                            </div>

                            <?php
                                echo "<a href=\"/users/{$usuario['id']}/edit\" class=\"btn btn-primary\">Editar Usuário</a>";
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="/assets/js/script.js"></script>
  </body>
</html>