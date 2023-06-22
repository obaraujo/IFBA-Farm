<?php
$numero_de_escritura = $_GET['id'];

if (!empty($numero_de_escritura)) {
  include('../../farm-connect.php');
  $conn->query("DELETE FROM Propriedades WHERE numero_de_escritura = '$numero_de_escritura'");
}
header("Location: ../../");
