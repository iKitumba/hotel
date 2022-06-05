<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $servicoID = $_GET['servico_id'];

      $query = $conexao->prepare("DELETE FROM servicos WHERE id = ?");

      $query->execute(array($servicoID));
  
        if($query->rowCount()){
          $servico = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=servicos`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.php`</script>";
      }
?>