<?php
$rutaJson = './Data/Rooms.json';
$roomsJson = file_get_contents($rutaJson);
$my_rooms = json_decode($roomsJson, true);


echo '<pre>';
print_r($my_rooms);
echo '</pre>';
?>