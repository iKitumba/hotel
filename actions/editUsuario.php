<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $usuario_id = $_GET['usuario_id'];
      $username = $_GET['username'];
      $password = $_GET['password'];
      $tipo_usuario = $_GET['tipo_usuario'];
      $funcionario_id = $_GET['funcionario_id'];

      $query = $conexao->prepare("UPDATE usuarios SET username = ?, password = ?, tipo_usuario = ?, funcionario_id = ? WHERE id = ?");

      $query->execute(array($username, $password, $tipo_usuario, $funcionario_id, $usuario_id));
  
        if($query->rowCount()){
          $usuario = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=usuarios`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>
