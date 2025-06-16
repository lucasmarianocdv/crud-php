<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (strlen($requestUri) > 1 && substr($requestUri, -1) === '/') {
    $requestUri = substr($requestUri, 0, -1);
}

global $controller;

switch ($requestUri) {

     case '/': 
        if ($requestMethod === 'GET') {
            header('Location: /users');
            exit;
        }
        break;

    case '/users':
        if ($requestMethod === 'GET') {
            $controller->index();
        } elseif ($requestMethod === 'POST') {
            $controller->store();
        }
        break;

    case '/users/create':
        if ($requestMethod === 'GET') {
            $controller->createForm();
        }
        break;

    default:
        if (preg_match('/^\/users\/(\d+)$/', $requestUri, $matches)) {
            $id = $matches[1];
            if ($requestMethod === 'GET') {
                $controller->show($id);
            } elseif ($requestMethod === 'POST') {
                if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
                     $controller->update($id);
                }
                 
                elseif (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') { 
                    $controller->destroy($id);
                }
                
                else {
                    $controller->update($id);
                }
            }
        } elseif (preg_match('/^\/users\/(\d+)\/edit$/', $requestUri, $matches)) {
            $id = $matches[1];
            if ($requestMethod === 'GET') {
                $controller->editForm($id);
            }
        }
        else {
            http_response_code(404);
            echo "<h1>404 - Página Não Encontrada</h1>";
        }
        break;
}