<?php
// Inicio de Sesion
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Crear conexión con MySQL segun los datos de la BD
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión para no ahiga error
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consulta SQL para obtener el usuario
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Guardar el usuario en sesión y redirigir a dashboard.php
        $_SESSION['username'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<h3 style='color: red;'>Credenciales incorrectas</h3>";
    }
}

$conn->close();
?>
