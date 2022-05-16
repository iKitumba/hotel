<?php
  require(__DIR__."/../actions/conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $bi_funcionario = $_GET['bi_funcionario'];

      $query = $conexao->prepare("SELECT * FROM funcionarios WHERE bi = ?");

      $query->execute(array($bi_funcionario));
  
        if($query->rowCount()){
          $funcionario = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funcionario - <?php echo $funcionario['nome'] ?> </title>
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

    .formEditarFuncionario {
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

    .formEditarFuncionario > label {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: .5rem;
      color: #999999;
      font-weight: bold;
    }

    .formEditarFuncionario > h1 {
      font-size: 3rem;
      align-self: flex-start;
    }

    .formEditarFuncionario input {
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

    .genero > label {
      display: flex;
      align-items: center;
      justify-content: center;
      flex: 1;
      padding: 1rem;
      gap: 1rem;
    }

    .genero > label > input {
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
  </style>
</head>
<body>
    <form class="formEditarFuncionario" action="../actions/editFuncionario.php">
        <h1>Editando <?php echo $funcionario['nome'] ?></h1>
        <input type="hidden" name="funcionario_id" value="<?php echo $funcionario['id'] ?>">
        <label>
          Nome completo
          <input type="text" name="nome" required value="<?php echo $funcionario['nome'] ?>">
        </label>
        <label>
          Bilhete Identidade
          <input type="text" name="bi" required value="<?php echo $funcionario['bi'] ?>">
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
              for($i = 0; $i < sizeof($cargos); $i++):
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
          <input type="text" name="endereco" required value="<?php echo $funcionario['endereco'] ?>">
        </label>
        <label>
          Numero telefone
          <input type="text" name="contacto" required value="<?php echo $funcionario['contacto'] ?>">
        </label>
        <label>
          Sálario
          <input type="number" name="salario" required value="<?php echo $funcionario['salario'] ?>">
        </label>
        <button type="submit" class="funcionarioButton">Guardar</button>
    </form>
</body>
</html>