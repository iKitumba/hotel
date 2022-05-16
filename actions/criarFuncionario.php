<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $nome = $_GET['nome'];
      $bi = $_GET['bi'];
      $genero = $_GET['genero'];
      $cargo_id = $_GET['cargo_id'];
      $endereco = $_GET['endereco'];
      $contacto = $_GET['contacto'];
      $salario = $_GET['salario'];


      $query = $conexao->prepare("INSERT INTO funcionarios(nome, bi, genero, contacto, endereco, salario, cargo_id) VALUES(?, ?, ?, ?, ?, ?, ?)");

      $query->execute(array($nome, $bi, $genero, $contacto, $endereco, $salario, $cargo_id));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=funcionarios`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>