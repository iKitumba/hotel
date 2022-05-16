<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $numero = $_GET['numero'];
      $codigo = $_GET['codigo'];
      $ocupado = $_GET['ocupado'];
      $dimensao = $_GET['dimensao'];
      $tipo_quarto = $_GET['tipo_quarto'];
      $descricao = $_GET['descricao'];

      $query = $conexao->prepare("INSERT INTO quartos(numero, codigo, ocupado, dimensao, tipo_quarto, descricao) VALUES(?, ?, ?, ?, ?, ?)");

      $query->execute(array($numero, $codigo, $ocupado, $dimensao, $tipo_quarto, $descricao));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=quartos`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>

