<?php
  require(__DIR__."/../actions/conexao.php");
?>

<section id="funcionariosPage">
  <header>
    <div>
      <h1>Funcionarios</h1>
      <h3>Listagem completa dos funcionarios</h3>
    </div>
    <a href="pages/addFuncionario.php">
      <button class="addFuncionarioButton">+</button>
    </a>
  </header>

  <table class="tabelaFuncionario">
    <thead>
      <tr>
        <td>Nome</td>
        <td>Contacto</td>
        <td class="hidden940">BI</td>
        <td class="hidden940">Genero</td>
        <td class="hidden600">Cargo</td>
        <td class="hidden940">Endereço</td>
        <td>Sálario</td>
        <td>Editar</td>
        <td class="hidden600">Remover</td>
      </tr>
    </thead>
    <?php
      $fecthFuncionarios = $conexao->prepare("SELECT * FROM funcionarios JOIN cargos ON funcionarios.cargo_id = cargos.id ORDER BY nome");

      $fecthFuncionarios->execute();
      $funcionarios = $fecthFuncionarios->fetchAll(PDO::FETCH_ASSOC);
      for($i = 0; $i < sizeof($funcionarios); $i++):
        $funcionarioActual = $funcionarios[$i];
    ?>      
    <tr>
      <td><?php echo $funcionarioActual['nome']; ?></td>
      <td><a href="tel:+<?php echo $funcionarioActual['contacto']; ?>"><?php echo $funcionarioActual['contacto']; ?></a></td>
      <td class="hidden940"><?php echo $funcionarioActual['bi']; ?></td>
      <td class="hidden940"><?php echo $funcionarioActual['genero']; ?></td>
      <td class="hidden600"><?php echo $funcionarioActual['titulo']; ?></td>
      <td class="hidden940"><?php echo $funcionarioActual['endereco']; ?></td>
      <td><?php echo $funcionarioActual['salario']; ?></td>
      <td>
        <a href="pages/editFuncionario.php?bi_funcionario=<?php echo $funcionarioActual['bi'] ?>">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" class="nc-icon-wrapper">
              <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#6f4ec9"></path>
            </g>
          </svg>
        </a>
      </td>
      <td class="hidden600">
        <a href="actions/deleteFuncionario.php?bi_funcionario=<?php echo $funcionarioActual['bi'] ?>">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" class="nc-icon-wrapper">
              <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" fill="#dc143c"></path>
            </g>
          </svg>
        </a>
      </td>
    </tr>
    <?php endfor ?>
  </table>
</section>