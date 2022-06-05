<?php
require(__DIR__ . "/../actions/conexao.php");
?>

<section>
  <article class="cards">
    <div class="card">
      <div class="title">Reservas</div>
      <div class="montante">
        <strong>922.800</strong><span class="up">+22%</span>
      </div>
      <div class="comparedTo">
        Comparado à semana passada
      </div>
    </div>
    <div class="card">
      <div class="title">Serviços</div>
      <div class="montante">
        <strong>200</strong><span class="down"> -122%</span>
      </div>
      <div class="comparedTo">
        Comparado à semana passada
      </div>
    </div>
    <div class="card">
      <div class="title">Valor Arrecadado</div>
      <div class="montante">
        <strong>$29.900.00</strong><span class="up">+12%</span>
      </div>
      <div class="comparedTo">
        Comparado à semana passada
      </div>
    </div>
  </article>
  <article class="graficoContainer">
    <h1>Anuário de Reservas</h1>
    <div class="grafico">
      <canvas id="myChart"></canvas>
    </div>
  </article>
  <div class="novosHopedesUltimosPagamentosContainer">
    <div class="novosHopedes">
      <h1>Novos Hospedes</h1>
      <div class="listagemHopedes">
        <?php
        $fecthHospedes = $conexao->prepare("SELECT * FROM hospedes ORDER BY criado_em");

        $fecthHospedes->execute();
        $hospedes = $fecthHospedes->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < sizeof($hospedes); $i++) :
          $hospedeActual = $hospedes[$i];
          $data_criado = $hospedeActual['criado_em'];
          $dadoscriado = explode('-', $data_criado);
          $anocriado = $dadoscriado[0];
          $mescriado = $dadoscriado[1];
          $diacriado = $dadoscriado[2];
          $datacriado = "$diacriado/$mescriado/$anocriado";
        ?>
          <div class="hospedeImgContainer">
            <figure class="hospedeImage">
              <div class="img">
                <img src="./assets/images/joker.jpg" />
              </div>
              <figcaption class="hopedeNameAndProf">
                <strong><?php echo $hospedeActual['nome'] ?></strong>
                <span><?php echo $hospedeActual['genero'] ?></span>
              </figcaption>
            </figure>
            <div class="hopedeNQuarto">
              Chegou aos: <?php echo $datacriado ?>
            </div>
          </div>
        <?php endfor ?>
      </div>
    </div>
    <div class="ultimosPagamentos">
      <h1>Últimas Tranzações</h1>
      <table class="tabelaUltimosPagamentos">
        <thead>
          <tr>
            <td>Responsável</td>
            <td class="pagamentoData">Data</td>
            <td>Montante</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Hello World</td>
            <td class="pagamentoData">12/05/2022</td>
            <td>$256,00</td>
          </tr>
          <tr>
            <td>Hello World</td>
            <td class="pagamentoData">12/05/2022</td>
            <td>$256,00</td>
          </tr>
          <tr>
            <td>Hello World</td>
            <td class="pagamentoData">12/05/2022</td>
            <td>$256,00</td>
          </tr>
          <tr>
            <td>Hello World</td>
            <td class="pagamentoData">12/05/2022</td>
            <td>$256,00</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>