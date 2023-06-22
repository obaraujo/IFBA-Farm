<?php include("../../../header.php"); ?>
<?php
include('../../../farm-connect.php');
$data_prop;
$data_local;
if (!empty($_GET['id'])) {
  $result = $conn->query("SELECT numero_de_escritura, nome, tamanho FROM Propriedades WHERE numero_de_escritura = " . $_GET['id'] . ";");
  $data_prop = $result->fetch_assoc();
  $result = $conn->query("SELECT cidade, estado, lagradouro, ponto_de_referencia FROM Localizacao WHERE numero_de_escritura_propriedade = " . $_GET['id'] . ";");
  $data_local = $result->fetch_assoc();
} else {
  header("Location: ../../../");
}
?>
<h3>Por favor, prencha os campos a seguir</h3>
<hr>
<form action="/Farm/pages/editar/propriedade/?id=<?php echo $data_prop["numero_de_escritura"]; ?>&edit=yes" method="post">
  <input required value="<?php echo $data_prop["numero_de_escritura"]; ?>" type="number" name="numero_de_escritura" placeholder="Número de Escritura">
  <input required value="<?php echo $data_prop["nome"];  ?>" type="text" name="nome" placeholder="Nome da propriedade">
  <input required value="<?php echo $data_prop["tamanho"];  ?>" type="number" name="tamanho" placeholder="Tamanho da propriedade">
  <input required value="<?php echo $data_local["cidade"];  ?>" type="text" name="cidade" placeholder="Cidade da propriedade">
  <input required value="<?php echo $data_local["estado"];  ?>" type="text" name="estado" placeholder="Estado (UF) da propriedade">
  <input required value="<?php echo $data_local["lagradouro"];  ?>" type="text" name="lagradouro" placeholder="Lagradouro da propriedade">
  <input required value="<?php echo $data_local["ponto_de_referencia"]; ?>" type="text" name="ponto_de_referencia" placeholder="Ponto de Referencia da propriedade">
  <button type="submit">Salvar</button>
</form>

<?php
if (!empty($_GET['edit'])) {
  $sql = "UPDATE Propriedades SET   numero_de_escritura = '" . $_POST['numero_de_escritura'] . "', nome = '" . $_POST['nome'] . "', tamanho = '" . $_POST['tamanho'] . "' WHERE Propriedades.numero_de_escritura = '" . $_GET['id'] . "';";
  $conn->query($sql);
  $sql = "UPDATE Localizacao SET cidade = '" . $_POST['cidade'] . "', estado = '" . $_POST['estado'] . "', lagradouro = '" . $_POST['lagradouro'] . "', ponto_de_referencia = '" . $_POST['ponto_de_referencia'] . "' WHERE Localizacao.numero_de_escritura_propriedade = '" . $_GET['id'] . "';";
  $conn->query($sql);
  header("Location: ../../../");
}
?>