<?php
require(__DIR__ . "/../actions/conexao.php");
session_start();

if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
  $codigo_reserva = $_GET['codigo_reserva'];

  $query = $conexao->prepare("SELECT * FROM reservas WHERE codigo = ?");

  $query->execute(array($codigo_reserva));

  if ($query->rowCount()) {
    $reserva = $query->fetchAll(PDO::FETCH_ASSOC)[0];
  }
} else {
  echo "<script>window.location = `../login.php`</script>";
}
?>


<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/ihotel-icon.svg" type="image/svg+xml">
  <title>Reserva - <?php echo $reserva['codigo'] ?></title>
  <style>
    * {
      margin: 0;
      padding: 0;
      outline: 0;
      box-sizing: border-box;
      -webkit-font-smoothing: antialiased !important;
      text-rendering: optimizeLegibility;
      font-family: Roboto, sans-serif;
      color: #333333;
    }

    body {
      width: 100%;
      min-height: 100vh;
      background-color: #ecf1f1;
    }

    .formEditaReserva {
      width: 600px;
      max-width: 100%;
      min-height: 100vh;
      margin: 0 auto;
      padding: 1rem;
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      gap: 1rem;
    }

    .formEditaReserva label {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: .5rem;
      color: #999999;
      font-weight: bold;
    }

    .formEditaReserva>h1 {
      font-size: 3rem;
      align-self: flex-start;
    }

    .formEditaReserva input {
      width: 100%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
      border: none;
      border: 2px solid #6f4ec9;
    }

    fieldset {
      width: 100%;
      border: 2px solid #6f4ec9;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    fieldset legend {
      font-size: 1rem;
      font-weight: bold;
      margin-left: 2rem;
      color: #999999;
    }

    fieldset select {
      width: 50%;
      height: 2.5rem;
      border: none;
      color: #333333;
      font-size: 1rem;
    }

    .reservarButton {
      width: 60%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      background: #6f4ec9;
      border-radius: 3rem;
      color: white;
      cursor: pointer;
      margin: 1rem 0;
      border: none;
    }

    .pace {
      -webkit-pointer-events: none;
      pointer-events: none;

      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    .pace-inactive {
      display: none;
    }

    .pace .pace-progress {
      background: #6f4ec9;
      position: fixed;
      z-index: 2000;
      top: 0;
      right: 100%;
      width: 100%;
      height: 2px;
    }
  </style>
</head>

<body>
  <form class="formEditaReserva" action="../actions/editReserva.php">
    <h1>Editando reserva</h1>
    <input type="hidden" name="reserva_id" value="<?php echo $reserva["id"] ?>">
    <label>
      Código para a reserva
      <input type="text" name="codigo" required value="<?php echo $reserva["codigo"] ?>">
    </label>
    <label>
      Status da reserva
      <input type="text" name="status" required value="<?php echo $reserva["status"] ?>">
    </label>
    <label>
      Data de entrada
      <input type="date" name="data_entrada" required value="<?php echo $reserva["data_entrada"] ?>">
    </label>
    <label>
      Data prevista para saída
      <input type="date" name="data_saida" required value="<?php echo $reserva["data_saida"] ?>">
    </label>
    <fieldset>
      <legend>Número do quarto</legend>
      <select name="quarto_id">
        <?php
        $fecthQuartos = $conexao->prepare("SELECT * FROM quartos");
        $fecthQuartos->execute();
        $quartos = $fecthQuartos->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < sizeof($quartos); $i++) :
          $quartoActual = $quartos[$i];
        ?>
          <option value="<?php echo $quartoActual["id"] ?>">
            <?php echo $quartoActual["numero"] ?>
          </option>
        <?php endfor ?>
      </select>
    </fieldset>
    <fieldset>
      <legend>Nome do hospede</legend>
      <select name="hospede_id">
        <?php
        $fecthHospedes = $conexao->prepare("SELECT * FROM hospedes");
        $fecthHospedes->execute();
        $hospedes = $fecthHospedes->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < sizeof($hospedes); $i++) :
          $hospedeActual = $hospedes[$i];
          print_r($hospedeActual);
        ?>
          <option value="<?php echo $hospedeActual["id"]; ?>">
            <?php echo $hospedeActual["nome"]; ?>
          </option>
        <?php endfor ?>
      </select>
    </fieldset>
    <button type="submit" class="reservarButton">Guardar</button>
  </form>

  <script src="../modules/pace.min.js"></script>
</body>

</html>