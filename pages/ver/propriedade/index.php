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
<h3>Os dados da propriedade <span style="text-transform: uppercase;"><?php echo $data_prop["nome"];  ?></span></h3>
<hr>
<div>
  <strong>Nome:</strong>
  <span><?php echo $data_prop["nome"];  ?></span>
</div>
<div>
  <strong>Nº de escrituta:</strong>
  <span><?php echo $data_prop["numero_de_escritura"];  ?></span>
</div>
<div>
  <strong>Tamanho:</strong>
  <span><?php echo $data_prop["tamanho"];  ?></span>
</div>
<div>
  <strong>Cidade:</strong>
  <span><?php echo $data_local["cidade"];  ?></span>
</div>
<div>
  <strong>Estado:</strong>
  <span><?php echo $data_local["estado"];  ?></span>
</div>
<div>
  <strong>Lagradouro:</strong>
  <span><?php echo $data_local["lagradouro"];  ?></span>
</div>
<div>
  <strong>Ponto de referencia:</strong>
  <span><?php echo $data_local["ponto_de_referencia"];  ?></span>
</div>

<h2>Plantações cadastradas</h2>
<?php
$data = $conn->query("SELECT id_plantacao,apelido, tamanho, data_de_plantio, numero_de_escritura_propriedade FROM Plantacoes WHERE numero_de_escritura_propriedade = " . $_GET['id'] . ";");
if ($data->num_rows > 0) { ?>
  <div style="text-align: center; height: 100vh; display: flex; flex-direction: column; margin: 1px">
    <table>
      <thead>
        <tr>
          <th>Apelido</th>
          <th>Tamanho</th>
          <th>Data de plantio</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $prop) : ?>
          <tr>
            <td><?php echo $prop['apelido']; ?></td>
            <td><?php echo $prop['tamanho']; ?></td>
            <td><?php echo $prop['data_de_plantio']; ?></td>
            <td>
              <a hidden href="/Farm/pages/deletar/plantacao/?id=<?php echo $prop['id_plantacao']; ?>&id_parent=<?php echo $prop['numero_de_escritura_propriedade']; ?>"></a>
              <button class="button d" onclick="confimar(this, '<?php echo $prop['apelido']; ?>')">Deletar</button>
              <a class="button" href="/Farm/pages/editar/plantacao/?id=<?php echo $prop['numero_de_escritura_propriedade']; ?>&id_plan=<?php echo $prop['id_plantacao']; ?>">Editar </a>
              <a class="button" href="/Farm/pages/ver/plantacao/?id=<?php echo $prop['numero_de_escritura_propriedade']; ?>">Ver</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      function confimar(e, prop) {
        const confirm = window.confirm('Deseja mesmo deletar a plantação ' + prop.toUpperCase() + " ?")
        if (confirm) {
          e.parentNode.children[0].click()
        }
      }
    </script>
    <h2>Deseja cadastrar mais?</h2>
    <a style="color: #efefef; background: #02b7ec; padding: 10px 50px; margin: 30px; font-weight: bold" href="/Farm/pages/cadastro/plantacao?id=<?php echo $_GET['id'] ?>">SIM</a>
  </div>

<?php
} else {
?>
  <div style="text-align: center; height: 100vh; display: flex; flex-direction: column; margin: 100px">
    <h1>Olá! Verificamos que você não possui nenhuma plantação cadastrada :(</h1>
    <h2>Deseja cadastrar agora?</h2>
    <a style="color: #efefef; background: #02b7ec; padding: 10px 50px; margin: 30px; font-weight: bold" href="/Farm/pages/cadastro/plantacao?id=<?php echo $_GET['id'] ?>">SIM</a>
  </div>
<?php
}

?>