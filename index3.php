<?php
$rutaJson = './Data/Rooms.json';
$roomsJson = file_get_contents($rutaJson);
$my_rooms = json_decode($roomsJson, true);
?>
<ol>
<?php foreach($my_rooms as $my_rooms):  ?>
<li>
    <b>Type</b>Type:<?php echo $my_rooms['room_type']?><br>
    <b>Number</b>:<?php echo $my_rooms['room_number']?><br>
    <b>Price</b>:<?php echo $my_rooms['room_price']?><br>
    <b>Discount</b>:<?php echo $my_rooms['room_offer']?><br>
</li>
<?php endforeach?>
</ol>