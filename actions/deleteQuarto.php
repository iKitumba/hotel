<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $quartoID = $_GET['quarto_id'];

      $query = $conexao->prepare("DELETE FROM quartos WHERE id = ?");

      $query->execute(array($quartoID));
  
        if($query->rowCount()){
          $quarto = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=quartos`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.php`</script>";
      }
?>

