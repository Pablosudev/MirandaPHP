<?php
if (isset($_GET['id'])) {

    $roomId = $_GET['id'];
    $rutaJson = './Data/Rooms.json';
    $roomsJson = file_get_contents($rutaJson);
    $my_rooms = json_decode($roomsJson, true);
    $roomFound = null;

    foreach($my_rooms  as $room){
        if($room['id'] == $roomId){
            $roomFound = $room;
            break;
        }
    }

    if($roomFound){
        echo '<h2>Room Details</h2>';
        echo '<p><b>Type</b>:'.htmlspecialchars($roomFound['room_type']).'</p>';
        echo '<p><b>Number</b>:'.htmlspecialchars($roomFound['room_number']).'</p>';
        echo '<p><b>Price</b>:'.htmlspecialchars($roomFound['room_price']).'</p>';
        echo '<p><b>Offer</b>:'.htmlspecialchars($roomFound['room_offer']).'</p>';
    } else {
        echo '<p>No room found with the given ID.</p>';
    }
}
?>

