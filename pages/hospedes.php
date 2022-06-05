<?php
require(__DIR__ . "/../actions/conexao.php");
?>

<section id="hospedesPage">
  <header>
    <div>
      <h1>Hospedes</h1>
      <h3>Listagem completa de hospedes</h3>
    </div>
    <button class="addHospedeButton">+</button>
  </header>
  <table class="tabelaHospedes">
    <thead>
      <tr>
        <td>Nome</td>
        <td>Telefone</td>
        <td class="hidden940">BI</td>
        <td class="hidden940">Genero</td>
        <td class="hidden940">Tipo Hospede</td>
        <td>Editar</td>
        <td class="hidden600">Remover</td>
      </tr>
    </thead>
    <?php
    $fecthHospedes = $conexao->prepare("SELECT * FROM tipos_hospedes JOIN hospedes ON tipos_hospedes.id = hospedes.tipo_hospede ORDER BY nome");

    $fecthHospedes->execute();
    $hospedes = $fecthHospedes->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < sizeof($hospedes); $i++) :
      $hospedeActual = $hospedes[$i];
    ?>
      <tr>
        <td><?php echo $hospedeActual['nome']; ?></td>
        <td><a href="tel:+<?php echo $hospedeActual['contacto']; ?>"><?php echo $hospedeActual['contacto']; ?></a></td>
        <td class="hidden940"><?php echo $hospedeActual['bi']; ?></td>
        <td class="hidden940"><?php echo $hospedeActual['genero']; ?></td>
        <td class="hidden940"><?php echo $hospedeActual['titulo']; ?></td>
        <td>
          <a href="pages/editHospede.php?hospede_id=<?php echo $hospedeActual['id'] ?>">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="none" class="nc-icon-wrapper">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#6f4ec9"></path>
              </g>
            </svg>
          </a>
        </td>
        <td class="hidden600">
          <a href="actions/deleteHospede.php?hospede_id=<?php echo $hospedeActual['id'] ?>">
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
  <div id="modal-hospede" class="modal-container">
    <div class="modal">
      <button class="fechar">x</button>
      <h2>Cadastrar Hospede</h2>
      <form method="GET" action="actions/cadastrarHospede.php">
        <input type="text" name="nome" placeholder="Nome Completo" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="text" name="bi" placeholder="BI" required>
        <div class="genero">
          <label>
            <input type="radio" name="genero" value="Masculino" checked> Masculino
          </label>
          <label>
            <input type="radio" name="genero" value="Femenino"> Femenino
          </label>
        </div>
        <select name="tipo_hospede">
          <?php
          $query = $conexao->prepare("SELECT * FROM tipos_hospedes");

          $query->execute();
          $users = $query->fetchAll(PDO::FETCH_ASSOC);
          for ($i = 0; $i < sizeof($users); $i++) :
            $usuarioAtual = $users[$i];
          ?>
            <option value=<?php echo $usuarioAtual["id"] ?>><?php echo $usuarioAtual['titulo'] ?></option>
          <?php endfor ?>
        </select>
        <button type="submit" class="cadastrar">Cadastrar</button>
      </form>
    </div>
  </div>
  <script>
    function iniciaModal(modalID) {
      const modal = document.getElementById(modalID);

      if (modal) {
        modal.classList.add('mostrar');

        modal.addEventListener('click', (e) => {
          if (e.target.id === modalID || e.target.className === 'fechar') {
            modal.classList.remove('mostrar');
          }
        });
      }
    }

    const botao = document.querySelector('.addHospedeButton');

    botao.addEventListener('click', () => iniciaModal('modal-hospede'));
  </script>
</section>