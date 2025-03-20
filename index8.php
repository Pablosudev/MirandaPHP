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
    $sql = "INSERT INTO rooms (type, number, price, offer, roomStatus, amenities, id) VALUES (?, ?, ?, ?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $type, $number, $price, $offer, $roomStatus, $amenities, $id);

    if ($stmt->execute()) {
        $message = "Habitatción creada exitosamente.";
        $new_room_id = $conn->insert_id;  // Obtener el ID de la habitación insertada
    } else {
        $message = "Error al crear la habitación: " . $stmt->error;
    }
    $stmt->close();
}

// Mostrar la habitación recién creada (si la inserción fue exitosa)
if (isset($new_room_id)) {
    $sql = "SELECT type, number, price, offer, roomStatus, amenities, id FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $new_room_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $habitacion_nueva = $result->fetch_assoc();
    $stmt->close();
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

<!-- Mostrar mensaje y habitación recién creada -->
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<?php if (isset($habitacion_nueva)): ?>
    <h3>Habitación Creada:</h3>
    <ul>
        <li><strong>Tipo:</strong> <?php echo $habitacion_nueva['type']; ?></li>
        <li><strong>Número:</strong> <?php echo $habitacion_nueva['number']; ?></li>
        <li><strong>Precio:</strong> <?php echo $habitacion_nueva['price']; ?></li>
        <li><strong>Oferta:</strong> <?php echo $habitacion_nueva['offer']; ?></li>
    </ul>
<?php endif; ?>
