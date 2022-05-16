<?php
  require(__DIR__."/../actions/conexao.php");
?>

<section id="reservasPage">
  <header>
    <div>
      <h1>Reservas</h1>
      <h3>Listagem completa das reservas</h3>
    </div>
    <a href="pages/addReserva.php">
      <button class="addReservaButton">+</button>
    </a>
  </header>

  <table class="tabelaHospedes">
    <thead>
      <tr>
        <td>Código</td>
        <td class="hidden940">Data de Entrada</td>
        <td class="hidden940">Data de Saída</td>
        <td class="hidden600">Status</td>
        <td>Nome Hospede</td>
        <td>Editar</td>
        <td class="hidden600">Remover</td>
      </tr>
    </thead>
    <?php
      $fecthReservas = $conexao->prepare("SELECT * FROM reservas JOIN hospedes ON reservas.hospede_id = hospedes.id JOIN tipos_quartos ON reservas.quarto_id = tipos_quartos.id");

      $fecthReservas->execute();
      $reservas = $fecthReservas->fetchAll(PDO::FETCH_ASSOC);
      for($i = 0; $i < sizeof($reservas); $i++):
        $reservaActual = $reservas[$i];
    ?>      
      <tr>
        <td><?php echo $reservaActual['codigo'] ?></td>
        <td class="hidden940"><?php echo $reservaActual['data_entrada'] ?></td>
        <td class="hidden940"><?php echo $reservaActual['data_saida'] ?></td>
        <td class="hidden600"><?php echo $reservaActual['status'] ?></td>
        <td><?php echo $reservaActual['nome'] ?></td>
        <td>
        <a href="pages/editReserva.php?codigo_reserva=<?php echo $reservaActual['codigo'] ?>">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" class="nc-icon-wrapper">
              <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#6f4ec9"></path>
            </g>
          </svg>
        </a>
      </td>
      <td class="hidden600">
        <a href="actions/deleteReserva.php?codigo_reserva=<?php echo $reservaActual['codigo'] ?>">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" class="nc-icon-wrapper">
              <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" fill="#dc143c"></path>
            </g>
          </svg>
        </a>
      </td>
    </tr>
    <?php endfor ?>
</section>