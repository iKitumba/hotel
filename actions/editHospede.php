<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $hospedeID = $_GET['hospede_id'];
      $nome = $_GET['nome'];
      $telefone = $_GET['telefone'];
      $bi = $_GET['bi'];
      $genero = $_GET['genero'];
      $tipo_hospede = $_GET['tipo_hospede'];

      $query = $conexao->prepare("UPDATE hospedes SET nome = ?, contacto = ?, bi = ?, genero = ?, tipo_hospede = ? WHERE id = ?");

      $query->execute(array($nome, $telefone, $bi, $genero, $tipo_hospede, $hospedeID));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=hospedes`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>
