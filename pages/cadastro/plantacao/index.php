<?php include("../../../header.php"); ?>
<h3>Por favor, prencha os campos a seguir</h3>
<hr>
<form action="/Farm/pages/cadastro/plantacao/?id=<?php echo $_GET['id'] ?>" method="post">
  <input required type="text" name="apelido" placeholder="Apelido da Plantação">
  <input required type="number" name="tamanho" placeholder="Tamanho da plantação">
  <input required type="date" name="data_de_plantio" placeholder="Data do plantio">
  <input required type="text" name="nome" placeholder="Cultura da Plantação">
  <input required type="text" name="especie" placeholder="Espécie da cultura">
  <input required type="text" name="classificacao" placeholder="Classificação (Legume, Grãos)">
  <button type="submit">Salvar</button>
</form>

<?php
if (!empty($_POST['apelido'])) {
  include('../../../farm-connect.php');

  $sql = "INSERT INTO Plantacoes( id_plantacao, apelido, tamanho, data_de_plantio, numero_de_escritura_propriedade) VALUES (NULL,'" . $_POST['apelido'] . "','" . $_POST['tamanho'] . "','" . $_POST['data_de_plantio'] . "','" . $_GET['id'] . "');";
  $conn->query($sql);
  $sql = "SELECT MAX(id_plantacao) as id FROM Plantacoes";
  $sql = $conn->query($sql);
  $row = $sql->fetch_assoc();
  $sql = "INSERT INTO Cultura( nome, especie, classificacao, plantacao_id) VALUES ('" . $_POST['nome'] . "','" . $_POST['especie'] . "','" . $_POST['classificacao'] . "','" . $row['id'] . "');";
  $conn->query($sql);
  header("Location: ../../ver/propriedade?id=" . $_GET['id']);
}
?>