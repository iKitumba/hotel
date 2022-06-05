<?php
    require("conexao.php");
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
      $bi_funcionario = $_GET['bi_funcionario'];

      $query = $conexao->prepare("DELETE FROM funcionarios WHERE bi = ?");
      try{
        $query->execute(array($bi_funcionario));
        print_r($query);
          if($query->rowCount()){
            $funcionario = $query->fetchAll(PDO::FETCH_ASSOC);
            echo "<script>window.location = `../index.php?p=funcionarios`</script>";
          }
      } catch (PDOException $erro) {
        echo "<title>Erro ao eliminar</title>";
        echo "<h1>Impossível eliminar esse Funcionario pós ele é um usuário do sistema</h1>";
        echo "<script> setTimeout(() =>window.location = `../index.php?p=funcionarios`, 3000)</script>";
      }
    } else {
      echo "<script>window.location = `../login.php`</script>";
    }
?>
