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
  <title>Cadastrar pagamentos</title>
</head>
<body>
  <h1>Cadastro de pagamentos</h1>
</body>
</html>