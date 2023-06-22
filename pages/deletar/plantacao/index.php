<?php
$id = $_GET['id'];
$numero_de_escritura = $_GET['id_parent'];


if (!empty($numero_de_escritura)) {
  include('../../../farm-connect.php');
  $conn->query("DELETE FROM Plantacoes WHERE id_plantacao = '$id'");
}
header("Location: ../../ver/propriedade?id=$numero_de_escritura");
