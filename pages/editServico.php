<?php
require(__DIR__ . "/../actions/conexao.php");
session_start();

if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
  $servicoID = $_GET['servico_id'];

  $query = $conexao->prepare("SELECT * FROM servicos WHERE id = ?");

  $query->execute(array($servicoID));

  if ($query->rowCount()) {
    $servico = $query->fetchAll(PDO::FETCH_ASSOC)[0];
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
  <title>Servico - <?php echo $servico['titulo'] ?></title>
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

    .formEditServico {
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

    .formEditServico>h1 {
      font-size: 3rem;
    }

    .formEditServico>input[type="text"],
    input[type="number"] {
      width: 100%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
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
  <form class="formEditServico" action="../actions/editServico.php">
    <h1>Editando #<?php echo $servico['titulo'] ?></h1>
    <input type="hidden" name="servico_id" value="<?php echo $servico['id'] ?>">
    <input type="text" name="titulo" placeholder="Título para o serviço" value="<?php echo $servico['titulo'] ?>">
    <input type="text" name="descrisao" placeholder="Descreve o serviço" value="<?php echo $servico['descrisao'] ?>">
    <input type="number" name="valor" placeholder="Quanto custa?" value="<?php echo $servico['valor'] ?>">
    <input type="number" name="quantidade" placeholder="Quantidade do serviço" value="<?php echo $servico['quantidade'] ?>">
    <button type="submit" class="guardar">Guardar</button>
  </form>

  <script src="../modules/pace.min.js"></script>
</body>

</html>