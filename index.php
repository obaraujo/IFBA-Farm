<?php
include("header.php");
include('farm-connect.php');

$data = $conn->query("SELECT * FROM Propriedades");
if ($data->num_rows > 0) { ?>
  <div style="text-align: center; height: 100vh; display: flex; flex-direction: column; margin: 100px">
    <h1>Olá! Aqui estão suas propriedades cadastradas :)</h1>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Nº de escrituta</th>
          <th>Tamanho</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $prop) : ?>
          <tr>
            <td><?php echo $prop['nome']; ?></td>
            <td><?php echo $prop['numero_de_escritura']; ?></td>
            <td><?php echo $prop['tamanho']; ?></td>
            <td>
              <a hidden href="/Farm/pages/deletar/?id=<?php echo $prop['numero_de_escritura']; ?>"></a>
              <button class="button d" onclick="confimar(this, '<?php echo $prop['nome']; ?>')">Deletar</button>
              <a class="button" href="/Farm/pages/editar/propriedade/?id=<?php echo $prop['numero_de_escritura']; ?>">Editar </a>
              <a class="button" href="/Farm/pages/ver/propriedade/?id=<?php echo $prop['numero_de_escritura']; ?>">Ver </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>
      function confimar(e, prop) {
        const confirm = window.confirm('Deseja mesmo deletar a porpriedade ' + prop.toUpperCase() + " ?")
        if (confirm) {
          e.parentNode.children[0].click()
        }
      }
    </script>
    <h2>Deseja cadastrar mais?</h2>
    <a style="color: #efefef; background: #02b7ec; padding: 10px 50px; margin: 30px; font-weight: bold" href="/Farm/pages/cadastro/propriedade">SIM</a>
  </div>

<?php
} else {
?>
  <div style="text-align: center; height: 100vh; display: flex; flex-direction: column; margin: 100px">
    <h1>Olá! Verificamos que você não possui nenhuma propriedade cadastrada :(</h1>
    <h2>Deseja cadastrar agora?</h2>
    <a style="color: #efefef; background: #02b7ec; padding: 10px 50px; margin: 30px; font-weight: bold" href="/Farm/pages/cadastro/propriedade">SIM</a>
  </div>
<?php
}

?>


<?php
include("footer.php");
?>