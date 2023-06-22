<?php include("../../../header.php");
include('../../../farm-connect.php');
$data_prop;
$data_local;
if (!empty($_GET['id'])) {
  $data = $conn->query("SELECT id_plantacao,apelido, tamanho, data_de_plantio FROM Plantacoes WHERE numero_de_escritura_propriedade = " . $_GET['id'] . " OR id_plantacao = " . $_GET['id'] . ";");
  $data_plan = $data->fetch_assoc();
  $data = $conn->query("SELECT nome, especie, classificacao, plantacao_id FROM Cultura WHERE plantacao_id = " . $data_plan['id_plantacao'] . ";");
  $data_cul = $data->fetch_assoc();
} ?>
<h3>Os dados da propriedade <span style="text-transform: uppercase;"><?php echo $data_plan["apelido"];  ?></span></h3>
<hr>
<div>
  <strong>Apelido:</strong>
  <span><?php echo $data_plan["apelido"];  ?></span>
</div>
<div>
  <strong>Tamanho:</strong>
  <span><?php echo $data_plan["tamanho"];  ?></span>
</div>
<div>
  <strong>Data de Plantio:</strong>
  <span><?php echo $data_plan["data_de_plantio"];  ?></span>
</div>
<div>
  <strong>Nome:</strong>
  <span><?php echo $data_cul["nome"];  ?></span>
</div>
<div>
  <strong>Espécie:</strong>
  <span><?php echo $data_cul["especie"];  ?></span>
</div>
<div>
  <strong>Classificação:</strong>
  <span><?php echo $data_cul["classificacao"];  ?></span>
</div>

<h2>Atividades cadastradas</h2>
<?php
$data = $conn->query("SELECT id_atividade, data, valor, plantacao_id, descricao FROM Atividades WHERE plantacao_id = " . $data_plan['id_plantacao']  . ";");
if ($data->num_rows > 0) { ?>
  <div style="text-align: center; height: 100vh; display: flex; flex-direction: column; margin: 1px">
    <table>
      <thead>
        <tr>
          <th>Data</th>
          <th>Valor</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $prop) : ?>
          <tr>
            <td><?php echo $prop['data']; ?></td>
            <td><?php echo $prop['valor']; ?></td>
            <td><?php echo $prop['descricao']; ?></td>
            <td>
              <a hidden href="/Farm/pages/deletar/atividade/?id=<?php echo $prop['id_atividade']; ?>&id_parent=<?php echo $_GET['id']; ?>"></a>
              <button class="button d" onclick="confimar(this, '<?php echo $prop['descricao']; ?>')">Deletar</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      function confimar(e, prop) {
        const confirm = window.confirm('Deseja mesmo deletar a atividade ' + prop.toUpperCase() + " ?")
        if (confirm) {
          e.parentNode.children[0].click()
        }
      }
    </script>
    <h2>Deseja cadastrar mais?</h2>
    <a style="color: #efefef; background: #02b7ec; padding: 10px 50px; margin: 30px; font-weight: bold" href="/Farm/pages/cadastro/atividade?id=<?php echo  $data_plan['id_plantacao']  ?>">SIM</a>
  </div>

<?php
} else {
?>
  <div style="text-align: center; height: 100vh; display: flex; flex-direction: column; margin: 100px">
    <h1>Olá! Verificamos que você não possui nenhuma atividade cadastrada :(</h1>
    <h2>Deseja cadastrar agora?</h2>
    <a style="color: #efefef; background: #02b7ec; padding: 10px 50px; margin: 30px; font-weight: bold" href="/Farm/pages/cadastro/atividade?id=<?php echo  $data_plan['id_plantacao']  ?>">SIM</a>
  </div>
<?php
}

?>