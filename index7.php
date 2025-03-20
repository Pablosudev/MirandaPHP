<?php
$servername = "localhost";
$username = "root";
$password = "24Miranda97";
$dbname = "hotelmiranda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT type, number, price, offer FROM rooms";
$result = $conn->query($sql);

$habitaciones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $habitaciones[] = $row;
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
<input type="text" placeholder="Search Room">
<button>Search</button>
<ol>
    <?php foreach ($habitaciones as $habitacion): ?>

        
        <li>
            <strong>Type:</strong> <?php echo $habitacion['type']; ?><br>
            <strong>Number:</strong> <?php echo $habitacion['number']; ?><br>
            <strong>Price:</strong> <?php echo $habitacion['price']; ?><br>
            <strong>Discount:</strong> <?php echo $habitacion['offer']; ?>
        </li>
    <?php endforeach; ?>
</ol>