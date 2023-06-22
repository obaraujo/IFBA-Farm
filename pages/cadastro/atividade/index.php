<?php include("../../../header.php"); ?>
<h3>Por favor, prencha os campos a seguir</h3>
<hr>
<form action="/Farm/pages/cadastro/atividade/?id=<?php echo $_GET['id'] ?>" method="post">
  <input required type="date" name="data" placeholder="">
  <input required type="number" name="valor" placeholder="Valor da atividae">
  <input required type="text" name="descricao" placeholder="Descrição">
  <label for="colheita">É colheita?</label>
  <label for="sim">Sim</label>
  <input type="radio" name="iscolheita" value="sim">
  <label for="nao">Não</label>
  <input type="radio" name="iscolheita" value="nao">
  <input required disabled class="iscolheita" type="number" name="valor_ganho" placeholder="Quanto você ganhou?">
  <input required disabled class="iscolheita" type="text" name="tipo" placeholder="Tipo (Caixas, kg, unidades)">
  <input required disabled class="iscolheita" type="number" name="valor" placeholder="Valor">
  <button type="submit">Salvar</button>
  <script>
    document.querySelectorAll('[name="iscolheita"]').forEach(iscolheita => {
      iscolheita.addEventListener('click', (e) => {
        if (e.target.value === 'sim') {
          document.querySelectorAll('.iscolheita').forEach(iscolheitaField => {
            iscolheitaField.removeAttribute('disabled')
          })
        } else {
          document.querySelectorAll('.iscolheita').forEach(iscolheitaField => {
            iscolheitaField.setAttribute('disabled', 'disabled')
            iscolheitaField.value = ""
          })
        }
      })
    })
  </script>
</form>

<?php
if (!empty($_POST['data'])) {
  include('../../../farm-connect.php');

  $sql = "INSERT INTO Atividades( id_atividade, data, valor, descricao, plantacao_id) VALUES (NULL,'" . $_POST['data'] . "','" . $_POST['valor'] . "','" . $_POST['descricao'] . "','" . $_GET['id'] . "');";
  $conn->query($sql);
  echo $_POST['iscolheita'];

  if ($_POST['iscolheita'] == 'sim') {
    $sql = "SELECT MAX(id_atividade) as id FROM Atividades";
    $sql = $conn->query($sql);
    $row = $sql->fetch_assoc();
    $sql = "INSERT INTO Colheitas( id_colheita, valor_ganho, atividade_id) VALUES (NULL,'" . $_POST['valor_ganho'] . "','" . $row['id'] . "');";
    $conn->query($sql);
    $sql = "SELECT MAX(id_colheita) as id FROM Colheitas";
    $sql = $conn->query($sql);
    $row = $sql->fetch_assoc();
    $sql = "INSERT INTO Quantidade( id_quantidade, tipo, valor, colheita_id) VALUES (NULL, '" . $_POST['tipo'] . "','" . $_POST['valor'] . "','" . $row['id'] . "');";
    $conn->query($sql);
    echo $sql;
  }
  header("Location: ../../ver/plantacao?id=" . $_GET['id']);
}
?>