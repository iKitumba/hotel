<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $codigo_reserva = $_GET['codigo_reserva'];

      $query = $conexao->prepare("DELETE FROM reservas WHERE codigo = ?");

      $query->execute(array($codigo_reserva));
  
        if($query->rowCount()){
          $reserva = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=reservas`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>

