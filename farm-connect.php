<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->query("CREATE DATABASE Farm") === TRUE) {
  include("farm-create-tables.php");
} else {
  $conn = new mysqli('localhost', 'root', '', "Farm");
}
