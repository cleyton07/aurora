<?php
class Cidade {
    private $conn;
    private $table_name = "cidades";

    public $id;
    public $nome;
    public $estado;
    public $descricao;
    public $imagem_url;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByID() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nome = $row['nome'];
            $this->estado = $row['estado'];
            $this->descricao = $row['descricao'];
            $this->imagem_url = $row['imagem_url'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nome=:nome, estado=:estado, descricao=:descricao, imagem_url=:imagem_url";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->imagem_url = htmlspecialchars(strip_tags($this->imagem_url));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem_url", $this->imagem_url);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET nome=:nome, estado=:estado, descricao=:descricao, imagem_url=:imagem_url 
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->imagem_url = htmlspecialchars(strip_tags($this->imagem_url));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem_url", $this->imagem_url);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>