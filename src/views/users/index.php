<?php
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include(__DIR__ . '/../layout/navbar.php'); ?>
    <div class="container mt-4">
      <?php include(__DIR__ . '/../layout/mensagem.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4> Lista de Usuários
                <a href="/users/create" class="btn btn-primary float-end">Adicionar usuário</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="/users" method="GET" class="mb-3">
                  <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Buscar por nome, email ou nickname..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                      <button type="submit" class="btn btn-outline-secondary">Buscar</button>
                  </div>
              </form>

              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data Nascimento</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($usuarios)): ?>
                    <?php foreach($usuarios as $usuario): ?>
                    <tr>
                      <td><?= htmlspecialchars($usuario['id']) ?></td>
                      <td><?= htmlspecialchars($usuario['nome']) ?></td>
                      <td><?= htmlspecialchars($usuario['email']) ?></td>
                      <td><?= htmlspecialchars(date('d/m/Y', strtotime($usuario['data_nascimento']))) ?></td>
                      <td>
                        <a href="/users/<?=$usuario['id']?>" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="/users/<?=$usuario['id']?>/edit" class="btn btn-success btn-sm">Editar</a>
                        <form action="/users/<?=$usuario['id']?>" method="POST" style="display:inline;">
                          <input type="hidden" name="_method" value="DELETE"> <button type="submit" name="delete_usuario_btn" class="btn btn-danger btn-sm"
                          onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                        </form>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5"><h5>Nenhum usuário encontrado!</h5></td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="/assets/js/script.js"></script>
  </body>
</html>