<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/Hotel.php';
include_once '../models/Restaurante.php';
include_once '../models/PontoTuristico.php';

$database = new Database();
$db = $database->getConnection();

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'all';
$cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '';

$response = array();
$response["locations"] = array();

try {
    switch($tipo) {
        case 'hoteis':
            $hotel = new Hotel($db);
            $stmt = $cidade ? $hotel->readByCidadeNome($cidade) : $hotel->read();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $location_item = array(
                    "id" => $row['id'],
                    "name" => $row['nome'],
                    "type" => "hotel",
                    "city" => $row['cidade_nome'],
                    "address" => $row['endereco'],
                    "phone" => $row['telefone'],
                    "website" => $row['website'],
                    "hours" => "Check-in: " . substr($row['check_in'], 0, 5) . ", Check-out: " . substr($row['check_out'], 0, 5),
                    "description" => $row['descricao'],
                    "image" => $row['imagem_url'],
                    "rating" => $row['estrelas'],
                    "price" => $row['preco_medio']
                );
                array_push($response["locations"], $location_item);
            }
            break;

        case 'restaurantes':
            $restaurante = new Restaurante($db);
            $stmt = $cidade ? $restaurante->readByCidadeNome($cidade) : $restaurante->read();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $location_item = array(
                    "id" => $row['id'],
                    "name" => $row['nome'],
                    "type" => "restaurant",
                    "city" => $row['cidade_nome'],
                    "address" => $row['endereco'],
                    "phone" => $row['telefone'],
                    "website" => $row['website'],
                    "hours" => $row['horario_funcionamento'],
                    "description" => $row['descricao'],
                    "image" => $row['imagem_url'],
                    "cuisine" => $row['tipo_culinaria'],
                    "price" => $row['preco_medio']
                );
                array_push($response["locations"], $location_item);
            }
            break;

        case 'pontos_turisticos':
            $ponto = new PontoTuristico($db);
            $stmt = $cidade ? $ponto->readByCidadeNome($cidade) : $ponto->read();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $location_item = array(
                    "id" => $row['id'],
                    "name" => $row['nome'],
                    "type" => "attraction",
                    "city" => $row['cidade_nome'],
                    "address" => $row['endereco'],
                    "phone" => $row['telefone'],
                    "website" => $row['website'],
                    "hours" => $row['horario_funcionamento'],
                    "description" => $row['descricao'],
                    "image" => $row['imagem_url'],
                    "attraction_type" => $row['tipo_atracao'],
                    "price" => $row['preco_entrada']
                );
                array_push($response["locations"], $location_item);
            }
            break;

        case 'all':
        default:
            // Hotéis
            $hotel = new Hotel($db);
            $stmt_hoteis = $cidade ? $hotel->readByCidadeNome($cidade) : $hotel->read();
            while ($row = $stmt_hoteis->fetch(PDO::FETCH_ASSOC)) {
                $location_item = array(
                    "id" => $row['id'],
                    "name" => $row['nome'],
                    "type" => "hotel",
                    "city" => $row['cidade_nome'],
                    "address" => $row['endereco'],
                    "phone" => $row['telefone'],
                    "website" => $row['website'],
                    "hours" => "Check-in: " . substr($row['check_in'], 0, 5) . ", Check-out: " . substr($row['check_out'], 0, 5),
                    "description" => $row['descricao'],
                    "image" => $row['imagem_url'],
                    "rating" => $row['estrelas']
                );
                array_push($response["locations"], $location_item);
            }

            // Restaurantes
            $restaurante = new Restaurante($db);
            $stmt_restaurantes = $cidade ? $restaurante->readByCidadeNome($cidade) : $restaurante->read();
            while ($row = $stmt_restaurantes->fetch(PDO::FETCH_ASSOC)) {
                $location_item = array(
                    "id" => $row['id'],
                    "name" => $row['nome'],
                    "type" => "restaurant",
                    "city" => $row['cidade_nome'],
                    "address" => $row['endereco'],
                    "phone" => $row['telefone'],
                    "website" => $row['website'],
                    "hours" => $row['horario_funcionamento'],
                    "description" => $row['descricao'],
                    "image" => $row['imagem_url']
                );
                array_push($response["locations"], $location_item);
            }

            // Pontos Turísticos
            $ponto = new PontoTuristico($db);
            $stmt_pontos = $cidade ? $ponto->readByCidadeNome($cidade) : $ponto->read();
            while ($row = $stmt_pontos->fetch(PDO::FETCH_ASSOC)) {
                $location_item = array(
                    "id" => $row['id'],
                    "name" => $row['nome'],
                    "type" => "attraction",
                    "city" => $row['cidade_nome'],
                    "address" => $row['endereco'],
                    "phone" => $row['telefone'],
                    "website" => $row['website'],
                    "hours" => $row['horario_funcionamento'],
                    "description" => $row['descricao'],
                    "image" => $row['imagem_url']
                );
                array_push($response["locations"], $location_item);
            }
            break;
    }

    $response["status"] = "success";
    $response["message"] = "Dados recuperados com sucesso";
    echo json_encode($response);

} catch (Exception $e) {
    $response["status"] = "error";
    $response["message"] = "Erro ao recuperar dados: " . $e->getMessage();
    echo json_encode($response);
}

// Adicionar método readByCidadeNome nos modelos
// No modelo Hotel.php, Restaurante.php e PontoTuristico.php adicione:
/*
public function readByCidadeNome($cidade_nome) {
    $query = "SELECT h.*, c.nome as cidade_nome 
             FROM " . $this->table_name . " h 
             LEFT JOIN cidades c ON h.cidade_id = c.id 
             WHERE c.nome LIKE ? 
             ORDER BY h.nome";
    $stmt = $this->conn->prepare($query);
    $cidade_param = "%" . $cidade_nome . "%";
    $stmt->bindParam(1, $cidade_param);
    $stmt->execute();
    return $stmt;
}
*/
?>