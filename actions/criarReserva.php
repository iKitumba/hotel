<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $codigo = $_GET['codigo'];
      $data_entrada = $_GET['data_entrada'];
      $data_saida = $_GET['data_saida'];
      $quarto_id = $_GET['quarto_id'];
      $hospede_id = $_GET['hospede_id'];

      $query = $conexao->prepare("INSERT INTO reservas(codigo, data_entrada, data_saida, quarto_id, hospede_id) VALUES(?, ?, ?, ?, ?)");

      $query->execute(array($codigo, $data_entrada, $data_saida, $quarto_id, $hospede_id));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=reservas`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>