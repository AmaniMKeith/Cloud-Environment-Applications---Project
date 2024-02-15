<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

include 'index.php';  // For database connection

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
  case 'GET':
    $stmt = $conn->prepare("SELECT * FROM transactions");
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($transactions);
    break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
      
        $stmt = $conn->prepare("INSERT INTO transactions (type, description, amount) 
                                VALUES (:type, :description, :amount)");
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->execute();
      
        echo json_encode(['success' => true, 'message' => 'Transaction added']);
        break;

  case 'DELETE':
    $id = $_GET['id']; // Assuming ID is passed in URL
    $stmt = $conn->prepare("DELETE FROM transactions WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo json_encode(['message' => 'Transaction deleted']);
    break;

  default:
    http_response_code(405); // Method not allowed
}
