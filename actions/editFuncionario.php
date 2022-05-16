<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $funcionario_id = $_GET['funcionario_id'];
      $nome = $_GET['nome'];
      $telefone = $_GET['contacto'];
      $bi = $_GET['bi'];
      $genero = $_GET['genero'];
      $cargo_id = $_GET['cargo_id'];
      $endereco = $_GET['endereco'];
      $salario = $_GET['salario'];

      $query = $conexao->prepare("UPDATE funcionarios SET nome = ?, contacto = ?, bi = ?, genero = ?, cargo_id = ?, endereco = ?, salario = ? WHERE id = ?");

      $query->execute(array($nome, $telefone, $bi, $genero, $cargo_id, $endereco, $salario, $funcionario_id));
  
        if($query->rowCount()){
          $hospede = $query->fetchAll(PDO::FETCH_ASSOC);
          echo "<script>window.location = `../index.php?p=funcionarios`</script>";
        }
      }
       else {
        echo "<script>window.location = `../login.html`</script>";
      }
?>
