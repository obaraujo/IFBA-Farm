<?php include("../../../header.php");
include('../../../farm-connect.php');
$data_prop;
$data_local;
if (!empty($_GET['id'])) {
  $data = $conn->query("SELECT id_plantacao,apelido, tamanho, data_de_plantio FROM Plantacoes WHERE numero_de_escritura_propriedade = " . $_GET['id'] . ";");
  $data_plan = $data->fetch_assoc();
  $data = $conn->query("SELECT nome, especie, classificacao, plantacao_id FROM Cultura WHERE plantacao_id = " . $_GET['id_plan'] . ";");
  $data_cul = $data->fetch_assoc();
} ?>
<h3>Por favor, prencha os campos a seguir</h3>
<hr>
<form action="/Farm/pages/editar/plantacao/?id=<?php echo $_GET['id'] ?>&id_plan=<?php echo $_GET['id_plan']; ?>" method="post">
  <input required value="<?php echo $data_plan["apelido"] ?>" type="text" name="apelido" placeholder="Apelido da Plantação">
  <input required value="<?php echo $data_plan["tamanho"] ?>" type="number" name="tamanho" placeholder="Tamanho da plantação">
  <input required value="<?php echo $data_plan["data_de_plantio"] ?>" type="date" name="data_de_plantio" placeholder="Data do plantio">
  <input required value="<?php echo $data_cul["nome"] ?>" type="text" name="nome" placeholder="Cultura da Plantação">
  <input required value="<?php echo $data_cul["especie"] ?>" type="text" name="especie" placeholder="Espécie da cultura">
  <input required value="<?php echo $data_cul["classificacao"] ?>" type="text" name="classificacao" placeholder="Classificação (Legume, Grãos)">
  <button type="submit">Salvar</button>
</form>

<?php
if (!empty($_POST['apelido'])) {
  include('../../../farm-connect.php');

  $sql = "UPDATE Plantacoes SET apelido = '" . $_POST['apelido'] . "', tamanho = '" . $_POST['tamanho'] . "', data_de_plantio = '" . $_POST['data_de_plantio'] . "' WHERE Plantacoes.id_plantacao = '" . $data_plan["id_plantacao"] . "';";
  $conn->query($sql);
  $sql = "UPDATE Cultura SET nome = '" . $_POST['nome'] . "', especie = '" . $_POST['especie'] . "', classificacao = '" . $_POST['classificacao'] . "' WHERE Cultura.plantacao_id = '" . $data_cul["plantacao_id"] . "';";
  $conn->query($sql);
  header("Location: ../../ver/propriedade?id=" . $_GET['id']);
}
