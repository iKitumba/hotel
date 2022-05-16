<?php
  require(__DIR__."/../actions/conexao.php");
?>

<section id="usuarioPage">
  <header>
    <div>
      <h1>Usuários</h1>
      <h3>Listagem completa dos usuarios</h3>
    </div>
    <button class="addUsuarioButton">+</button>
  </header>

  <table class="tabelaUsuario">
    <thead>
      <tr>
        <td>Username</td>
        <td>Telefone</td>
        <td class="hidden940">Nome Funcionario</td>
        <td class="hidden940">Grupo</td>
        <td>Editar</td>
        <td class="hidden600">Remover</td>
      </tr>
    </thead>
    <?php
      $fecthUsuarios = $conexao->prepare("SELECT * FROM usuarios JOIN tipos_usuarios ON usuarios.tipo_usuario = tipos_usuarios.id JOIN funcionarios ON usuarios.funcionario_id = funcionarios.id ORDER BY username");

      $fecthUsuarios->execute();
      $usuarios = $fecthUsuarios->fetchAll(PDO::FETCH_ASSOC);
      for($i = 0; $i < sizeof($usuarios); $i++):
        $usuarioActual = $usuarios[$i];
    ?>      
    <tr>
      <td><?php echo $usuarioActual['username']; ?></td>
      <td><a href="tel:+<?php echo $usuarioActual['contacto']; ?>"><?php echo $usuarioActual['contacto']; ?></a></td>
      <td class="hidden940"><?php echo $usuarioActual['nome']; ?></td>
      <td class="hidden940"><?php echo $usuarioActual['titulo']; ?></td>
      <td>
        <a href="pages/editUsuario.php?username=<?php echo $usuarioActual['username'] ?>">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" class="nc-icon-wrapper">
              <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#6f4ec9"></path>
            </g>
          </svg>
        </a>
      </td>
      <td class="hidden600">
        <a href="actions/deleteUsuario.php?username=<?php echo $usuarioActual['username'] ?>">
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

  <div id="modal-usuario" class="modal-container">
    <div class="modal">
      <button class="fechar">x</button>
      <h2>Cadastrar usuário</h2>
      <form method="POST" action="actions/cadastrarUsuario.php">
        <input type="text" name="username" placeholder="Username(sem_espacos)" required>
        <input type="password" name="password" placeholder="Senha" required>
        <div class="tipo_usuario_funcionario_id">
          <select name="tipo_usuario">
            <?php
                $fetchTiposUsuarios = $conexao->prepare("SELECT * FROM tipos_usuarios");

                $fetchTiposUsuarios->execute();
                $types = $fetchTiposUsuarios->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < sizeof($types); $i++):
                  $tipoAtual = $types[$i];
            ?>
            <option value=<?php echo $tipoAtual["id"]?>><?php echo $tipoAtual['titulo'] ?></option>
            <?php endfor ?>
          </select>
          <select name="funcionario_id">
            <?php
                $fetchFuncionarios = $conexao->prepare("SELECT * FROM funcionarios");

                $fetchFuncionarios->execute();
                $funcionarios = $fetchFuncionarios->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < sizeof($funcionarios); $i++):
                  $funcionarioAtual = $funcionarios[$i];
            ?>
            <option value=<?php echo $funcionarioAtual["id"]?>><?php echo $funcionarioAtual['nome'] ?></option>
            <?php endfor ?>
          </select>        
        </div>

        <button type="submit" class="cadastrar">Cadastrar</button>
      </form>
    </div>
  </div>
  <script>
    function iniciaModal(modalID) {
      const modal = document.getElementById(modalID);

      if(modal) {
        modal.classList.add('mostrar');

        modal.addEventListener('click', (e) => {
          if (e.target.id === modalID || e.target.className === 'fechar') {
            modal.classList.remove('mostrar');
          }
        });
      }
    }

    const botao = document.querySelector('.addUsuarioButton');

    botao.addEventListener('click', () => iniciaModal('modal-usuario'));

  </script>
</section>