<?php
class Hotel {
    private $conn;
    private $table_name = "hoteis";

    public $id;
    public $nome;
    public $cidade_id;
    public $endereco;
    public $telefone;
    public $website;
    public $check_in;
    public $check_out;
    public $descricao;
    public $imagem_url;
    public $estrelas;
    public $preco_medio;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT h.*, c.nome as cidade_nome 
                 FROM " . $this->table_name . " h 
                 LEFT JOIN cidades c ON h.cidade_id = c.id 
                 ORDER BY h.nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByCidade($cidade_id) {
        $query = "SELECT h.*, c.nome as cidade_nome 
                 FROM " . $this->table_name . " h 
                 LEFT JOIN cidades c ON h.cidade_id = c.id 
                 WHERE h.cidade_id = ? 
                 ORDER BY h.nome";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cidade_id);
        $stmt->execute();
        return $stmt;
    }

    public function readByID() {
        $query = "SELECT h.*, c.nome as cidade_nome 
                 FROM " . $this->table_name . " h 
                 LEFT JOIN cidades c ON h.cidade_id = c.id 
                 WHERE h.id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nome = $row['nome'];
            $this->cidade_id = $row['cidade_id'];
            $this->endereco = $row['endereco'];
            $this->telefone = $row['telefone'];
            $this->website = $row['website'];
            $this->check_in = $row['check_in'];
            $this->check_out = $row['check_out'];
            $this->descricao = $row['descricao'];
            $this->imagem_url = $row['imagem_url'];
            $this->estrelas = $row['estrelas'];
            $this->preco_medio = $row['preco_medio'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nome=:nome, cidade_id=:cidade_id, endereco=:endereco, telefone=:telefone, 
                     website=:website, check_in=:check_in, check_out=:check_out, descricao=:descricao, 
                     imagem_url=:imagem_url, estrelas=:estrelas, preco_medio=:preco_medio";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->website = htmlspecialchars(strip_tags($this->website));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->imagem_url = htmlspecialchars(strip_tags($this->imagem_url));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cidade_id", $this->cidade_id);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":website", $this->website);
        $stmt->bindParam(":check_in", $this->check_in);
        $stmt->bindParam(":check_out", $this->check_out);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem_url", $this->imagem_url);
        $stmt->bindParam(":estrelas", $this->estrelas);
        $stmt->bindParam(":preco_medio", $this->preco_medio);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET nome=:nome, cidade_id=:cidade_id, endereco=:endereco, telefone=:telefone, 
                     website=:website, check_in=:check_in, check_out=:check_out, descricao=:descricao, 
                     imagem_url=:imagem_url, estrelas=:estrelas, preco_medio=:preco_medio 
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->website = htmlspecialchars(strip_tags($this->website));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->imagem_url = htmlspecialchars(strip_tags($this->imagem_url));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cidade_id", $this->cidade_id);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":website", $this->website);
        $stmt->bindParam(":check_in", $this->check_in);
        $stmt->bindParam(":check_out", $this->check_out);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem_url", $this->imagem_url);
        $stmt->bindParam(":estrelas", $this->estrelas);
        $stmt->bindParam(":preco_medio", $this->preco_medio);
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