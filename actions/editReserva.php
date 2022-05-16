<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $reserva_id = $_GET['reserva_id'];
      $codigo = $_GET['codigo'];
      $data_entrada = $_GET['data_entrada'];
      $data_saida = $_GET['data_saida'];
      $quarto_id = $_GET['quarto_id'];
      $hospede_id = $_GET['hospede_id'];
      $status = $_GET['status'];


      $query = $conexao->prepare("UPDATE reservas SET codigo = ?, data_entrada = ?, data_saida = ?, quarto_id = ?, hospede_id = ?, status = ? WHERE id = ?");

      $query->execute(array($codigo, $data_entrada, $data_saida, $quarto_id, $hospede_id, $status, $reserva_id));
  
        if($query->rowCount()){
          $quarto = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=reservas`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>
