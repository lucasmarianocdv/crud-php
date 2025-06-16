<?php

$oldInput = $_SESSION['old_input'] ?? [];
unset($_SESSION['old_input']); 

$nome_value = $oldInput['nome'] ?? ($usuario['nome'] ?? '');
$email_value = $oldInput['email'] ?? ($usuario['email'] ?? '');
$data_nascimento_value = $oldInput['data_nascimento'] ?? ($usuario['data_nascimento'] ?? '');
$nickname_value = $oldInput['nickname'] ?? ($usuario['nickname'] ?? '');
$telefone_value = $oldInput['telefone'] ?? ($usuario['telefone'] ?? '');
$escritorio_value = $oldInput['escritorio'] ?? ($usuario['escritorio'] ?? '');

if (!isset($usuario) || !$usuario) 
{
    echo "<h4>Usuário não encontrado para edição!</h4>";
    echo '<a href="/users" class="btn btn-danger mt-3">Voltar à Lista</a>';
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários - Editar</title>
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
                            <h4>Editar Usuário
                                <a href="/users" class="btn btn-danger float-end">Voltar</a>
                            </h4>
                        </div>
                    <div class="card-body">
                        <form action="/users/<?= htmlspecialchars($usuario['id']) ?>" method="POST">
                            <input type="hidden" name="_method" value="PUT">

                            <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuario['id']) ?>">

                            <div class="mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($nome_value) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($email_value) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="data_nascimento">Data de Nascimento</label>
                                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?= htmlspecialchars($data_nascimento_value) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nickname">Nickname</label>
                                <input type="text" name="nickname" id="nickname" class="form-control" value="<?= htmlspecialchars($nickname_value) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="<?= htmlspecialchars($telefone_value) ?>">
                            </div>
                             <div class="mb-3">
                                <label for="escritorio">Escritório</label>
                                <input type="text" name="escritorio" id="escritorio" class="form-control" value="<?= htmlspecialchars($escritorio_value) ?>">
                            </div>
                            <div class="mb-3">
                              <button type="submit" name="usuario_edit" class="btn btn-primary">Atualizar</button>
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