<?php

require_once __DIR__ . '/../services/DatabaseService.php';

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = DatabaseService::getInstance();
    }

    public function create($data)
    {
        $nome = $data['nome'];
        $email = $data['email'];
        $data_nascimento = $data['data_nascimento'];
        $nickname = $data['nickname'];
        $telefone = $data['telefone'];
        $escritorio = $data['escritorio'];

        $sql = "INSERT INTO usuarios (nome, email, data_nascimento, nickname, telefone, escritorio) 
                VALUES (:nome, :email, :data_nascimento, :nickname, :telefone, :escritorio)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':escritorio', $escritorio);

        return $stmt->execute();
    }

 
    public function update($id, $data)
    {
        $update_fields = []; 
        $bind_params = [];

        foreach ($data as $key => $value) 
        {
            if ($key !== 'id')
            {
                $update_fields[] = "$key = :$key";
                $bind_params[":$key"] = $value;
            }
        }

        if (empty($update_fields)) {
            return 0; 
        }

        $sql = "UPDATE usuarios SET " . implode(', ', $update_fields) . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        foreach ($bind_params as $placeholder => $value) 
        {
            $stmt->bindValue($placeholder, $value);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->rowCount();

    }

    public function delete($id_usuario) 
    {
        $sql_delete = "DELETE FROM usuarios WHERE id = :id_usuario";
        $stmt_delete = $this->conn->prepare($sql_delete);
        $stmt_delete->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt_delete->execute();
        return $stmt_delete->rowCount();

    }

    public function search($searchTerm)
    {
        $sql = "SELECT id, nome, email, data_nascimento, nickname FROM usuarios 
                WHERE nome ILIKE :searchTerm OR email ILIKE :searchTerm OR nickname ILIKE :searchTerm";
        $stmt = $this->conn->prepare($sql);
        $likeTerm = '%' . $searchTerm . '%';
        $stmt->bindParam(':searchTerm', $likeTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $sql = "SELECT id, nome, email, data_nascimento, nickname, telefone, escritorio FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        try {
           
            $sql = "SELECT id, nome, email, data_nascimento, nickname FROM usuarios ORDER BY id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro no método getAll() do User Model: " . $e->getMessage());
            return [];
        }
    }
}