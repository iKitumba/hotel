<?php
  require(__DIR__."/../actions/conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $username = $_GET['username'];

      $query = $conexao->prepare("SELECT * FROM usuarios WHERE username = ?");

      $query->execute(array($username));
  
        if($query->rowCount()){
          $usuario = $query->fetchAll(PDO::FETCH_ASSOC)[0];
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
  <title>Usuário - <?php echo $usuario['username'] ?></title>
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

    .formEditUsuario {
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

    .formEditUsuario > h1 {
      font-size: 3rem;
      align-self: flex-start;
    }

    label {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: .5rem;
      color: #999999;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      height: 2.5rem;
      padding: 1rem;
      font-size: 1rem;
      border: 2px solid #6f4ec9;
    }

  .tipo_usuario_funcionario_id {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
  }

    .tipo_usuario_funcionario_id select {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      flex: 1;
      font-size: 1rem;
      padding: .5rem 1rem;
      border: 2px solid #6f4ec9;
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
    <form class="formEditUsuario" action="../actions/editUsuario.php">
        <h1>Editando #<?php echo $usuario['username'] ?></h1>
          <input type="hidden" name="usuario_id" value="<?php echo $usuario['id'] ?>">
        <label> Edite username
          <input type="text" name="username" value="<?php echo $usuario['username'] ?>">
        </label>
        <label> Edite senha
          <input type="password" name="password" value="<?php echo $usuario['password'] ?>">
        </label>
        <div class="tipo_usuario_funcionario_id">       
        <select name="tipo_usuario">
            <?php
                $fetchTiposUsuarios = $conexao->prepare("SELECT * FROM tipos_usuarios");

                $fetchTiposUsuarios->execute();
                $types = $fetchTiposUsuarios->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < sizeof($types); $i++):
                  $tipoAtual = $types[$i];
            ?>
            <option value=<?php echo $tipoAtual["id"]?>><?php echo $tipoAtual['titulo'] ?></option>
            <?php endfor ?>
          </select>
          <select name="funcionario_id">
            <?php
                $fetchFuncionarios = $conexao->prepare("SELECT * FROM funcionarios");

                $fetchFuncionarios->execute();
                $funcionarios = $fetchFuncionarios->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < sizeof($funcionarios); $i++):
                  $funcionarioAtual = $funcionarios[$i];
            ?>
            <option value=<?php echo $funcionarioAtual["id"]?>><?php echo $funcionarioAtual['nome'] ?></option>
            <?php endfor ?>
          </select>        
        </div>

        <button type="submit" class="guardar">Guardar</button>
    </form>
</body>
</html>