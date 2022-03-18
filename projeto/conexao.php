<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "projeto";
$port = 3308;

$conn = new PDO ("mysql:host=$host;port=$port;dbname=".$dbname,$user,$pass);
