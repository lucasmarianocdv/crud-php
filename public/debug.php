<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/init.php';
echo "bootstrap.php carregado com sucesso.\n";

if (isset($controller) && $controller instanceof UserController) {
    echo "Controller instanciado com sucesso: " . get_class($controller) . "\n";
} else {
    echo "ERRO: Controller NÃO instanciado ou não é um UserController.\n";
    var_dump($controller);
}
?>