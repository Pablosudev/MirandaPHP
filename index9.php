<?php
$servername = "localhost";
$username = "root";
$password = "24Miranda97";
$dbname = "hotelmiranda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha hecho una petición POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $type = $_POST['type'];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];
    $roomStatus = $_POST['roomStatus'];
    $amenities = $_POST['amenities'];

    // Insertar la nueva habitación en la base de datos
    $sql = "INSERT INTO rooms (id, type, number, price, offer, roomStatus, amenities) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Aquí estamos pasando 7 parámetros, uno por cada campo
    $stmt->bind_param("issssss", $id, $type, $number, $price, $offer, $roomStatus, $amenities);

    if ($stmt->execute()) {
        $message = "Habitatción creada exitosamente.";
    } else {
        $message = "Error al crear la habitación: " . $stmt->error;
    }
    $stmt->close();
}

// Mostrar mensaje
if (isset($message)) {
    echo "<p>$message</p>";
}

$conn->close();
?>

<!-- Formulario para crear una nueva habitación -->
<form method="POST">
    <label for="type">Tipo:</label>
    <input type="text" id="type" name="type" required><br>

    <label for="number">Número:</label>
    <input type="number" id="number" name="number" required><br>

    <label for="price">Precio:</label>
    <input type="text" id="price" name="price" required><br>

    <label for="offer">Oferta:</label>
    <input type="text" id="offer" name="offer"><br>

    <label for="id">Id:</label>
    <input type="text" id="id" name="id" required><br>

    <label for="amenities">Amenities:</label>
    <input type="text" id="amenities" name="amenities" required><br>

    <label for="roomStatus">Status:</label>
    <input type="text" id="roomStatus" name="roomStatus" required><br>

    <button type="submit">Crear Habitación</button>
</form>

<p>Verifica la habitación en <a href="index5.php">index5.php</a></p>
