<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $servicoID = $_GET['servico_id'];
      $titulo = $_GET['titulo'];
      $descrisao = $_GET['descrisao'];
      $valor = $_GET['valor'];
      $quantidade = $_GET['quantidade'];

      $query = $conexao->prepare("UPDATE servicos SET titulo = ?, descrisao = ?, valor = ?, quantidade = ? WHERE id = ?");

      $query->execute(array($titulo, $descrisao, $valor, $quantidade, $servicoID));
  
        if($query->rowCount()){
          $servico = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=servicos`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.php`</script>";
      }
?>
