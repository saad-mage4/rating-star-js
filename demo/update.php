<?php
$con = mysqli_connect('localhost', 'root', 'admin123', 'testo');
$rating = $_POST['rating'];
$con->query("UPDATE `rating` SET `rating`='$rating' WHERE `id`='1'");
echo $rating;
