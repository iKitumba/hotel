<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $hospedeID = $_GET['hospede_id'];

      $query = $conexao->prepare("DELETE FROM hospedes WHERE id = ?");

      $query->execute(array($hospedeID));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=hospedes`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.php`</script>";
      }
?>

