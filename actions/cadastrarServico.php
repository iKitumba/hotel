<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $titulo = $_GET['titulo'];
      $descrisao = $_GET['descrisao'];
      $valor = $_GET['valor'];
      $quantidade = $_GET['quantidade'];

      $query = $conexao->prepare("INSERT INTO servicos(titulo, descrisao, valor, quantidade) VALUES(?, ?, ?, ?)");

      $query->execute(array($titulo, $descrisao, $valor, $quantidade));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=servicos`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.php`</script>";
      }
?>

