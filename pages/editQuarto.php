<?php
require(__DIR__ . "/../actions/conexao.php");
session_start();

if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
  $quartoID = $_GET['quarto_id'];

  $query = $conexao->prepare("SELECT * FROM quartos WHERE id = ?");

  $query->execute(array($quartoID));

  if ($query->rowCount()) {
    $quarto = $query->fetchAll(PDO::FETCH_ASSOC)[0];
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
  <title>Quarto - <?php echo $quarto['numero'] ?></title>
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

    .formEditQuarto {
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

    .formEditQuarto>h1 {
      font-size: 3rem;
    }

    .formEditQuarto>input[type="text"],
    input[type="number"] {
      width: 100%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
      border: none;
    }

    .ocupado {
      display: flex;
      align-items: center;
      justify-content: space-around;
      flex-wrap: wrap;
      width: 100%;
    }

    .ocupado {
      display: flex;
      align-items: center;
      justify-content: space-around;
      flex-wrap: wrap;
      width: 100%;
      font-size: 1rem;
      border: none;
    }

    .ocupado legend {
      margin-left: 2rem;
      font-size: 1.2rem;
    }

    .ocupado>label {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
    }

    select[name="tipo_quarto"] {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      width: 40%;
      font-size: 1rem;
      padding: .5rem 1rem;
      border: none;
    }

    .guardar {
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

    input[type="radio"] {
      width: 1.5rem;
      height: 1.5rem;
      border-radius: 1rem;
      border: 2px solid #988b7a;
      padding: 1rem;
      background: #988b7a;
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
  <form class="formEditQuarto" action="../actions/editQuarto.php">
    <h1>Editando <?php echo $quarto['codigo'] ?></h1>
    <input type="hidden" name="quarto_id" value="<?php echo $quarto['id'] ?>">
    <input type="number" name="numero" placeholder="Numero do quarto" required value="<?php echo $quarto['numero'] ?>">
    <input type="text" name="codigo" placeholder="codigo" required value="<?php echo $quarto['codigo'] ?>">
    <input type="text" name="dimensao" placeholder="dimensao" required value="<?php echo $quarto['dimensao'] ?>">
    <fieldset class="ocupado">
      <legend>Ocupado?</legend>
      <label>
        <input type="radio" name="ocupado" value="Nao" checked> Não
      </label>
      <label>
        <input type="radio" name="ocupado" value="Sim"> Sim
      </label>
    </fieldset>
    <select name="tipo_quarto">
      <?php
      $fecthQuartos = $conexao->prepare("SELECT * FROM tipos_quartos");

      $fecthQuartos->execute(array());
      $tiposQuartos = $fecthQuartos->fetchAll(PDO::FETCH_ASSOC);
      for ($i = 0; $i < sizeof($tiposQuartos); $i++) :
        $quartoAtual = $tiposQuartos[$i];
        print_r($quartoAtual);
      ?>
        <option value=<?php echo $quartoAtual["id"] ?>><?php echo $quartoAtual['titulo'] ?></option>
      <?php endfor ?>
    </select>
    <input type="text" name="descricao" placeholder="Descrição" required value="<?php echo $quarto['descricao'] ?>">
    <button type="submit" class="guardar">Guardar</button>
  </form>

  <script src="../modules/pace.min.js"></script>
</body>

</html>