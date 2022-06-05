<?php
require(__DIR__ . "/../actions/conexao.php");
session_start();

if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
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
  <title>Código de Reserva</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      outline: 0;
      box-sizing: border-box;
      -webkit-font-smoothing: antialiased !important;
      text-rendering: optimizeLegibility;
      font-family: Roboto, sans-serif;
    }

    body {
      width: 100%;
      min-height: 100vh;
    }

    .container {
      background: #ecf1f1;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .container>form {
      width: 600px;
      max-width: 100%;
      padding: 1rem;
      margin: 0 auto;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      gap: 2rem;
    }

    h1 {
      font-size: 2.25rem;
      font-weight: 400;
      color: #333333;
    }

    select {
      width: 80%;
      height: 2.5rem;
      padding: 0 1rem;
      border: 2px solid #6f4ec9;
      font-size: 1rem;
    }

    select option {
      width: 100%;
      font-size: 1rem;
      padding: 1rem;
    }

    button {
      width: 80%;
      height: 2.5rem;
      background: #6f4ec9;
      font-size: 0.875rem;
      font-weight: bold;
      color: #dddddd;
      background: #6f4ec9;
      border: 2px solid #6f4ec9;
      cursor: pointer;
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
  <div class="container">
    <form action="./addPagamento.php">
      <h1>Qual é o Código da Reserva?</h1>
      <select name="id_reserva">
        <?php
        $fetchReservas = $conexao->prepare("SELECT * FROM reservas");
        $fetchReservas->execute();
        $reservas = $fetchReservas->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < sizeof($reservas); $i++) :
          $reservaActual = $reservas[$i];
        ?>
          <option value="<?php echo $reservaActual["id"]; ?>">
            <?php echo $reservaActual["codigo"]; ?>
          </option>
        <?php endfor ?>
      </select>
      <button type="submit">Seguinte</button>
    </form>

  </div>

  <script src="../modules/pace.min.js"></script>
</body>

</html>