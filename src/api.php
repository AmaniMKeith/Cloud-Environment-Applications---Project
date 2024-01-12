// api.php
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST requests (e.g., add transaction)
    $action = $_POST['action'];
    
    if ($action === 'addTransaction') {
        addTransaction();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET requests (e.g., fetch transactions, get balance)
    $action = $_GET['action'];

    if ($action === 'getTransactions') {
        getTransactions();
    } elseif ($action === 'getBalance') {
        getBalance();
    }
}

function addTransaction() {
    global $conn;

    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $sql = "INSERT INTO transactions (category, amount, type, date) VALUES ('$category', $amount, '$type', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Transaction added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getTransactions() {
    global $conn;

    $sql = "SELECT * FROM transactions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['category']}</td>";
            echo "<td>{$row['amount']}</td>";
            echo "<td>{$row['type']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No transactions found</td></tr>";
    }
}

function getBalance() {
    global $conn;

    $sql = "SELECT SUM(CASE WHEN type='income' THEN amount ELSE -amount END) AS balance FROM transactions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo number_format($row['balance'], 2);
    } else {
        echo "0.00";
    }
}
?>
