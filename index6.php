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
<ol>
<?php foreach($habitaciones as $habitacion):  ?>
<li>
    <b>Type</b>Type:<?php echo $habitacion['type']?><br>
    <b>Number</b>:<?php echo $habitacion['number']?><br>
    <b>Price</b>:<?php echo $habitacion['price']?><br>
    <b>Discount</b>:<?php echo $habitacion['offer']?><br>
</li>
<?php endforeach?>
</ol>