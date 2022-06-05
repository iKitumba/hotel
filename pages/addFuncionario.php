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
  <title>Funcionarios</title>
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

    .formCriarFuncionario {
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

    .formCriarFuncionario>label {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: .5rem;
      color: #999999;
      font-weight: bold;
    }

    .formCriarFuncionario>h1 {
      font-size: 3rem;
      align-self: flex-start;
    }

    .formCriarFuncionario input {
      width: 100%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
      border: none;
      border: 2px solid #6f4ec9;
    }

    .genero {
      width: 100%;
      height: 2.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .genero>label {
      display: flex;
      align-items: center;
      justify-content: center;
      flex: 1;
      padding: 1rem;
      gap: 1rem;
    }

    .genero>label>input {
      width: 7%;
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

    .funcionarioButton {
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
  <form class="formCriarFuncionario" action="../actions/criarFuncionario.php">
    <h1>Cadastrar Funcionario</h1>
    <label>
      Nome completo
      <input type="text" name="nome" required>
    </label>
    <label>
      Bilhete Identidade
      <input type="text" name="bi" required>
    </label>
    <div class="genero">
      <label>
        <input type="radio" name="genero" value="Masculino" checked> Masculino
      </label>
      <label>
        <input type="radio" name="genero" value="Femenino"> Femenino
      </label>
    </div>

    <fieldset>
      <legend>Cargo a exercer</legend>
      <select name="cargo_id">
        <?php
        $fecthCargos = $conexao->prepare("SELECT * FROM cargos");
        $fecthCargos->execute();
        $cargos = $fecthCargos->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < sizeof($cargos); $i++) :
          $cargoActual = $cargos[$i];
          print_r($cargoActual);
        ?>
          <option value="<?php echo $cargoActual["id"]; ?>">
            <?php echo $cargoActual["titulo"]; ?>
          </option>
        <?php endfor ?>
      </select>
    </fieldset>
    <label>
      Endereço
      <input type="text" name="endereco" required>
    </label>
    <label>
      Numero telefone
      <input type="text" name="contacto" required>
    </label>
    <label>
      Sálario
      <input type="number" name="salario" required>
    </label>
    <button type="submit" class="funcionarioButton">Cadastrar</button>
  </form>

  <script src="../modules/pace.min.js"></script>
</body>

</html>