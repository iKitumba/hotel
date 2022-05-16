<?php
  require(__DIR__."/../actions/conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $hospedeID = $_GET['hospede_id'];

      $query = $conexao->prepare("SELECT * FROM hospedes WHERE id = ?");

      $query->execute(array($hospedeID));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC)[0];
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
  <title>Hospede - <?php echo $hospede['nome'] ?></title>
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

    .formEditHospede {
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

    .formEditHospede > h1 {
      font-size: 3rem;
    }

    .formEditHospede > input[type="text"] {
      width: 100%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
      border: none;
    }

    
    .genero {
      display: flex;
      align-items: center;
      justify-content: space-around;
      flex-wrap: wrap;
      width: 100%;
    }

    .genero > label {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
    }

    select[name="tipo_hospede"] {
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
  </style>
</head>
<body>
    <form class="formEditHospede" action="../actions/editHospede.php">
        <h1>Editando <?php echo $hospede['nome'] ?></h1>
        <input type="hidden" name="hospede_id" value="<?php echo $hospede['id'] ?>">
        <input type="text" name="nome" placeholder="Nome Completo" required value="<?php echo $hospede['nome'] ?>">
        <input type="text" name="telefone" placeholder="Telefone" required value="<?php echo $hospede['contacto'] ?>">
        <input type="text" name="bi" placeholder="BI" required value="<?php echo $hospede['bi'] ?>">
        <div class="genero">
          <label> 
            <input type="radio" name="genero" value="Masculino" checked> Masculino
          </label>
          <label>
            <input type="radio" name="genero" value="Femenino"> Femenino
          </label>
        </div>
        <select name="tipo_hospede">
          <?php
              $query = $conexao->prepare("SELECT * FROM tipos_hospedes");

              $query->execute();
              $users = $query->fetchAll(PDO::FETCH_ASSOC);
              for($i = 0; $i < sizeof($users); $i++):
                $usuarioAtual = $users[$i];
          ?>
          <option value=<?php echo $usuarioAtual["id"]?>><?php echo $usuarioAtual['titulo'] ?></option>
          <?php endfor ?>
        </select>
        <button type="submit" class="guardar">Guardar</button>
    </form>
</body>
</html>