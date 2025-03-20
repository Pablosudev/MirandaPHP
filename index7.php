<?php
$servername = "localhost";
$username = "root";
$password = "24Miranda97";
$dbname = "hotelmiranda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificamos si hay una búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Si hay una búsqueda, modificamos la consulta SQL
if ($search) {
    $sql = "SELECT type, number, price, offer FROM rooms WHERE type LIKE ? OR number LIKE ? OR price LIKE ? OR offer LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_term = "%$search%";
    $stmt->bind_param("ssss", $search_term, $search_term, $search_term, $search_term);
} else {+
    // Si no hay búsqueda, obtenemos todas las habitaciones
    $sql = "SELECT type, number, price, offer FROM rooms";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$habitaciones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $habitaciones[] = $row;
    }
} else {
    echo "0 resultados";
}

$stmt->close();
$conn->close();
?>

<!-- Formulario de búsqueda sin método ni acción -->
<form id="searchForm">
    <input type="text" id="searchInput" placeholder="Search Room" value="<?php echo htmlspecialchars($search); ?>">
    <button type="button" onclick="searchRooms()">Search</button>
</form>

<!-- Lista de habitaciones -->
<ol id="habitacionesList">
    <?php foreach ($habitaciones as $habitacion): ?>
        <li>
            <strong>Type:</strong> <?php echo $habitacion['type']; ?><br>
            <strong>Number:</strong> <?php echo $habitacion['number']; ?><br>
            <strong>Price:</strong> <?php echo $habitacion['price']; ?><br>
            <strong>Discount:</strong> <?php echo $habitacion['offer']; ?>
        </li>
    <?php endforeach; ?>
</ol>

<!-- JavaScript para realizar la búsqueda sin recargar la página -->
<script>
    function searchRooms() {
        var searchValue = document.getElementById('searchInput').value;
        window.location.href = '?search=' + encodeURIComponent(searchValue);  // Redirige con el parámetro de búsqueda
    }
</script>
