<?php
$oldInput = $_SESSION['old_input'] ?? [];
unset($_SESSION['old_input']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários - Adicionar</title>
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
                            <h4>Adicionar Usuários
                                <a href="/users" class="btn btn-danger float-end">Voltar</a>
                            </h4>
                        </div>
                    <div class="card-body">
                        <form action="/users" method="POST">
                            <div class="mb-3">
                                <label for="nome">Nome <span class="text-danger">*</span></label>
                                <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($oldInput['nome'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="data_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
                                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?= htmlspecialchars($oldInput['data_nascimento'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nickname">Nickname</label>
                                <input type="text" name="nickname" id="nickname" class="form-control" value="<?= htmlspecialchars($oldInput['nickname'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="<?= htmlspecialchars($oldInput['telefone'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="escritorio">Escritório</label>
                                <input type="text" name="escritorio" id="escritorio" class="form-control" value="<?= htmlspecialchars($oldInput['escritorio'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                              <button type="submit" name="create_usuario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="/assets/js/script.js"></script>
  </body>
</html>