<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $quartoID = $_GET['quarto_id'];
      $numero = $_GET['numero'];
      $codigo = $_GET['codigo'];
      $ocupado = $_GET['ocupado'];
      $dimensao = $_GET['dimensao'];
      $tipo_quarto = $_GET['tipo_quarto'];
      $descricao = $_GET['descricao'];

      $query = $conexao->prepare("UPDATE quartos SET numero = ?, codigo = ?, ocupado = ?, dimensao = ?, tipo_quarto = ?, descricao = ? WHERE id = ?");

      $query->execute(array($numero, $codigo, $ocupado, $dimensao, $tipo_quarto, $descricao, $quartoID));
  
        if($query->rowCount()){
          $quarto = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=quartos`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>
