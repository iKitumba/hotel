<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $tipo_usuario = $_POST['tipo_usuario'];
      $funcionario_id = $_POST['funcionario_id'];

      $query = $conexao->prepare("INSERT INTO usuarios(username, password, funcionario_id, tipo_usuario) VALUES(?, ?, ?, ?)");

      $query->execute(array($username, $password, $funcionario_id, $tipo_usuario));
  
        if($query->rowCount()){
          $usuario = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=usuarios`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.php`</script>";
      }
?>