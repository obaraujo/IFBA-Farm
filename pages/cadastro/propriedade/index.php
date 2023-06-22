<?php include("../../../header.php"); ?>
<h3>Por favor, prencha os campos a seguir</h3>
<hr>
<form action="/Farm/pages/cadastro/propriedade/" method="post">
  <input required type="number" name="numero_de_escritura" placeholder="Número de Escritura">
  <input required type="text" name="nome" placeholder="Nome da propriedade">
  <input required type="number" name="tamanho" placeholder="Tamanho da propriedade">
  <input required type="text" name="cidade" placeholder="Cidade da propriedade">
  <input required type="text" name="estado" placeholder="Estado (UF) da propriedade">
  <input required type="text" name="lagradouro" placeholder="Lagradouro da propriedade">
  <input required type="text" name="ponto_de_referencia" placeholder="Ponto de Referencia da propriedade">
  <button type="submit">Salvar</button>
</form>

<?php
if (!empty($_POST['numero_de_escritura'])) {
  include('../../../farm-connect.php');

  $sql = "INSERT INTO Propriedades(numero_de_escritura, nome, tamanho) VALUES ('" . $_POST['numero_de_escritura'] . "','" . $_POST['nome'] . "','" . $_POST['tamanho'] . "');";
  $conn->query($sql);
  $sql = "INSERT INTO Localizacao (id_localizacao, cidade, estado, lagradouro, ponto_de_referencia, numero_de_escritura_propriedade) VALUES (NULL,'" . $_POST['cidade'] . "','" . $_POST['estado'] . "','" . $_POST['lagradouro'] . "','" . $_POST['ponto_de_referencia'] . "','" . $_POST['numero_de_escritura'] . "');";
  $conn->query($sql);
  header("Location: ../../../");
}
?>