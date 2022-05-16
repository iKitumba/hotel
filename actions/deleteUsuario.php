<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $username = $_GET['username'];

      $query = $conexao->prepare("DELETE FROM usuarios WHERE username = ?");

      $query->execute(array($username));
  
        if($query->rowCount()){
          $user = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=usuarios`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>