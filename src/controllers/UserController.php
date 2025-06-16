<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../helpers/Validation.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function store()

    {
       
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $data_nascimento = trim($_POST['data_nascimento'] ?? '');
        $nickname = trim($_POST['nickname'] ?? null);
        $telefone = trim($_POST['telefone'] ?? null); 
        $escritorio = trim($_POST['escritorio'] ?? null); 

        
        $errors = [];

        if (empty($nome)) {
            $errors[] = 'O nome é obrigatório.';
        }
        if (empty($email)) {
            $errors[] = 'O email é obrigatório.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'O email fornecido é inválido.';
        }
        if (empty($data_nascimento)) {
            $errors[] = 'A data de nascimento é obrigatória.';
        } elseif (!ValidationHelper::isValidDate($data_nascimento)) {
            $errors[] = 'A data de nascimento é inválida.';
        }

        if (!empty($telefone)) {
            if (!ValidationHelper::isValidPhone($telefone)) 
            {
                $errors[] = 'O número de telefone não é válido.';
            }
        }
        if (!empty($errors)) {
            $_SESSION['mensagem'] = implode('<br>', $errors);
            $_SESSION['old_input'] = $_POST;
            header('Location: /users/create');
            exit;
        }

       
        $data = [
            'nome' => $nome,
            'email' => $email,
            'data_nascimento' => $data_nascimento,
            'nickname' => $nickname,
            'telefone' => $telefone,
            'escritorio' => $escritorio,
        ];

        try {
            if ($this->userModel->create($data)) {
                $_SESSION['mensagem'] = 'Usuário cadastrado com sucesso!';
                header('Location: /users'); 
                exit;
            } else {
                $_SESSION['mensagem'] = 'Erro ao cadastrar usuário. Por favor, tente novamente.';
                header('Location: /users/create'); 
                exit;
            }
        } catch (PDOException $e) {
        
            error_log("Erro no cadastro de usuário: " . $e->getMessage() . " - Dados: " . var_export($data, true));
            $_SESSION['mensagem'] = 'Ocorreu um erro inesperado ao cadastrar o usuário.';
            header('Location: /users/create');
            exit;
        }
    }

     public function editForm($id)

    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            $_SESSION['mensagem'] = 'ID de usuário inválido para edição!';
            header('Location: /users');
            exit;
        }

        $usuario = $this->userModel->findById($id);

        if (!$usuario) {
            $_SESSION['mensagem'] = 'Usuário não encontrado para edição!';
            header('Location: /users');
            exit;
        }

        include __DIR__ . '/../views/users/edit.php';
    }


    public function update($id)

    {

        $id_usuario = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id_usuario)
        {
            $_SESSION['mensagem'] = 'ID de usuário inválido para atualização!';
            header('Location: /users');
            exit;
        }

        
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $data_nascimento = trim($_POST['data_nascimento'] ?? '');
        $nickname = trim($_POST['nickname'] ?? null); 
        $telefone = trim($_POST['telefone'] ?? null); 
        $escritorio = trim($_POST['escritorio'] ?? null);


        $errors = [];
        if (!empty($nome))
        {
            $erros[] = 'O nome fornecido é inválido.';
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $errors[] = 'O email fornecido é inválido.';
        }
        if (!empty($data_nascimento) && !ValidationHelper::isValidDate($data_nascimento)) 
        {
            $errors[] = 'A data de nascimento é inválida.';
        }

        if (!empty($telefone)) {
            if (!ValidationHelper::isValidPhone($telefone)) 
            {
                $errors[] = 'O número de telefone não é válido.';
            }
        }

        if (!empty($errors)) 
        {
            $_SESSION['mensagem'] = implode('<br>', $errors);
            header('Location: /users/' . $id . '/edit');
            exit;
        }

        $data_to_update = [];

        if (!empty($nome)) $data_to_update['nome'] = $nome;
        if (!empty($email)) $data_to_update['email'] = $email;
        if (!empty($data_nascimento)) $data_to_update['data_nascimento'] = $data_nascimento;
        if (isset($_POST['nickname'])) $data_to_update['nickname'] = $nickname;
        if (isset($_POST['telefone'])) $data_to_update['telefone'] = $telefone;
        if (isset($_POST['escritorio'])) $data_to_update['escritorio'] = $escritorio;


        if (empty($data_to_update)) {
            $_SESSION['mensagem'] = 'Nenhum dado fornecido para atualização do usuário!';
            header('Location: /users/' . $id . '/edit');
            exit;
        }


        try {
            $rows_affected = $this->userModel->update($id_usuario, $data_to_update);

            if ($rows_affected > 0) 
            {
                $_SESSION['mensagem'] = 'Usuário atualizado com sucesso!';
            } 
            elseif ($rows_affected === 0) 
            {
                $_SESSION['mensagem'] = 'Nenhum usuário foi atualizado (ID ' . $id_usuario . ' encontrado, mas sem mudanças nos campos).';
            } 
            else 
            {
                $_SESSION['mensagem'] = 'Erro desconhecido na atualização do usuário!';
            }
            header('Location: /users');
            exit;
        } catch (PDOException $e) {
            error_log("PDOException na atualização do usuário: " . $e->getMessage() .
                      " - SQL: " . var_export($data_to_update, true) .
                      " - ID: " . $id_usuario);
            $_SESSION['mensagem'] = 'Erro ao atualizar o usuário. Por favor, tente novamente.';
            header('Location: /users/' . $id . '/edit');
            exit;
        }
    }

    public function show($id)

    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            $_SESSION['mensagem'] = 'ID de usuário inválido para visualização!';
            header('Location: /users');
        }

        $usuario = $this->userModel->findById($id);

        if (!$usuario) {
            $_SESSION['mensagem'] = 'Usuário não encontrado!';
            header('Location: /users');
        }

        include __DIR__ . '/../views/users/show.php';
    }

    public function destroy($id)

    {
        $id_usuario = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id_usuario) {
            $_SESSION['mensagem'] = 'ID de usuário inválido para exclusão!';
            header('Location: /users');
            exit;
        }

        try {
            $rows_affected = $this->userModel->delete($id_usuario);

            if ($rows_affected > 0) {
                $_SESSION['mensagem'] = 'Usuário excluído com sucesso!';
            } else {
                $_SESSION['mensagem'] = 'Nenhum usuário foi excluído (ID ' . $id_usuario . ' não encontrado).';
            }
            header('Location: /users');
            exit;
        } catch (PDOException $e) {
            error_log("PDOException na exclusão do usuário: " . $e->getMessage() .
                      " - ID: " . $id_usuario);
            $_SESSION['mensagem'] = 'Erro ao excluir o usuário. Por favor, tente novamente.';
            header('Location: /users');
            exit;
        }
    }

    public function createForm() 
    {
        include __DIR__ . '/../views/users/create.php';
    }

    public function index()

    {
        
        $searchTerm = $_GET['search'] ?? '';
        
        if (!empty($searchTerm)) {
            $usuarios = $this->userModel->search($searchTerm);
        } else {
            $usuarios = $this->userModel->getAll();
        }
        
        include __DIR__ . '/../views/users/index.php';

    }

}

