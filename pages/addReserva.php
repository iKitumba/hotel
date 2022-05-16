<?php
  require(__DIR__."/../actions/conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){

      }else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Reserva</title>
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

    .formCriarReserva {
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

    .formCriarReserva label {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: .5rem;
      color: #999999;
      font-weight: bold;
    }

    .formCriarReserva > h1 {
      font-size: 3rem;
      align-self: flex-start;
    }

    .formCriarReserva input {
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
  </style>
</head>
<body>
    <form class="formCriarReserva" action="../actions/criarReserva.php">
        <h1>Criando reserva</h1>
        <label>
          Código para a reserva
          <input type="text" name="codigo" required>
        </label>
        <label>
          Data de entrada
          <input type="date" name="data_entrada" required>
        </label>
        <label>
          Data prevista para saída
          <input type="date" name="data_saida" required>
        </label>
        <fieldset>
          <legend>Número do quarto</legend>
          <select name="quarto_id">
            <?php
              $fecthQuartos = $conexao->prepare("SELECT * FROM quartos");
              $fecthQuartos->execute();
              $quartos = $fecthQuartos->fetchAll(PDO::FETCH_ASSOC);
              for($i = 0; $i < sizeof($quartos); $i++):
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
              for($i = 0; $i < sizeof($hospedes); $i++):
                $hospedeActual = $hospedes[$i];
                print_r($hospedeActual);
            ?>
              <option value="<?php echo $hospedeActual["id"]; ?>">
                <?php echo $hospedeActual["nome"]; ?>
              </option>
            <?php endfor ?>
          </select>
        </fieldset>
        <button type="submit" class="reservarButton">Reservar</button>
    </form>
</body>
</html>