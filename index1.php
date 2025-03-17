<?php
$my_id = array (1,2,3);
$my_type = array("Suite", "Double Bed", "Double Superior", "Single Bed");
$my_number = 1;
$my_price=array(100,150,200,250);
$my_offer= array(10,20);


// Rooms

$room1 = array ("id" => $my_id[0], "my_type" => $my_type[2], "number" => $my_number++, "price" => $my_price[2], "offer" => $my_offer[0]);

//print_r($room1);

echo "<br>";

$room2 = array ("id" => $my_id[1], "my_type" => $my_type[0], "number" => $my_number++, "price" => $my_price[3], "offer" => $my_offer[0]);

//print_r($room2);

echo "<br>";

$room3 = array ("id" => $my_id[2], "my_type" => $my_type[1], "number" => $my_number++, "price" => $my_price[1], "offer" => $my_offer[1]);

//print_r($room3);


$allRooms = array ($room1,$room2,$room3);
print_r($allRooms);
?>

