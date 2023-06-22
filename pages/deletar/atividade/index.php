<?php
$id = $_GET['id'];
$numero_de_escritura = intval($_GET['id_parent']);


if (!empty($numero_de_escritura)) {
  include('../../../farm-connect.php');
  $conn->query("DELETE FROM Atividades WHERE id_atividade = '$id'");
}
header("Location: ../../ver/plantacao?id=$numero_de_escritura");
