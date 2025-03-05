<?php
session_start();
include 'Formulario.php'; // Conexión a MySQL

// Si el usuario no ha iniciado sesión, devolver error
if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "No autorizado"]);
    exit();
}

// Obtener datos de la tabla `users`
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode(["username" => $_SESSION['username'], "users" => $users]);

$conn->close();
?>
